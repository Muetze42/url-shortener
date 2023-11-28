<?php

namespace App\Jobs;

use App\Models\Url;
use Browser;
use hisorange\BrowserDetect\Contracts\ResultInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Symfony\Component\HttpFoundation\HeaderBag;

class UrlVisited implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The Url instance.
     *
     * @var \App\Models\Url
     */
    protected Url $url;

    /**
     * The client user agent.
     *
     * @var string
     */
    protected string $userAgent;

    /**
     * The anonymize client IP address.
     *
     * @var string
     */
    protected string $clientIp;

    /**
     * The HeaderBag instance.
     *
     * @var HeaderBag
     */
    protected HeaderBag $headerBag;

    /**
     * The HeaderBag instance
     *
     * @var string|null
     */
    protected ?string $ref;

    /**
     * Create a new job instance.
     */
    public function __construct(Url $url, string $userAgent, string $clientIp, HeaderBag $headerBag, ?string $ref)
    {
        $this->url = $url;
        $this->userAgent = $userAgent;
        $this->clientIp = $clientIp;
        $this->headerBag = $headerBag;
        $this->ref = $ref;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $browser = Browser::parse($this->userAgent);

        $attributes = [
            'device_type' => $browser->deviceType(),
            'browser_family' => $browser->browserFamily(),
            'browser_version' => $browser->browserVersion(),
            'browser_engine' => $browser->browserEngine(),
            'platform_family' => $browser->platformFamily(),
            'platform_version' => $browser->platformVersion(),
            'device_family' => $browser->deviceFamily(),
            'device_model' => $browser->deviceModel(),
            'crawler' => $this->getCrawler($browser),
            'ip' => $this->clientIp,
        ];

        $browserHash = md5(implode('', $attributes));

        $visitsIncrement = 0;

        /* @var \App\Models\Visit $visits */
        $visits = $this->url->visits();
        if (!$visits->where($attributes)->logCurrent()->exists()) {
            $visitsIncrement++;
            $this->url->visits()->create($attributes);
        }

        if ($referer = $this->headerBag->get('referer')) {
            /* @var \App\Models\VisitReferrer $referrers */
            $referrers = $this->url->referrers();
            if (!$referrers->where('browser_hash', $browserHash)->logCurrent()->exists()) {
                $referrers->create([
                    'url' => $referer,
                    'browser_hash' => $browserHash,
                ]);
            }
        }

        if ($this->ref) {
            /* @var \App\Models\VisitRef $refs */
            $refs = $this->url->refs();
            if (!$refs->where('browser_hash', $browserHash)->logCurrent()->exists()) {
                $this->url->refs()->create([
                    'value' => $this->ref,
                    'browser_hash' => $browserHash,
                ]);
            }
        }

        Url::withoutTimestamps(fn () => $this->url->update([
            'visits' => $this->url->visits + $visitsIncrement,
            'visits_total' => $this->url->visits_total + 1,
            'last_visit' => now(),
        ]));
    }

    /**
     * Get the matching Crawler by User Agent.
     *
     * @param \hisorange\BrowserDetect\Contracts\ResultInterface $browser
     *
     * @return string|null
     */
    protected function getCrawler(ResultInterface $browser): ?string
    {
        if (!$browser->isBot()) {
            return null;
        }

        $crawler = new CrawlerDetect(
            getFormattedHeaders($this->headerBag),
            $this->userAgent
        );
        $crawler->isCrawler();

        return $crawler->getMatches();
    }
}
