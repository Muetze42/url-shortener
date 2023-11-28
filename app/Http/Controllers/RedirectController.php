<?php

namespace App\Http\Controllers;

use App\Jobs\UrlVisited;
use App\Models\Url;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Url $url)
    {
        UrlVisited::dispatch(
            url: $url,
            userAgent: $request->userAgent(),
            clientIp: anonymizeIp($request->getClientIp()),
            headerBag: $request->headers,
            ref: $request->input('ref')
        );

        return redirect($url->target);
    }
}
