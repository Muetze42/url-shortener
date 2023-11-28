<?php

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\HeaderBag;

if (!function_exists('anonymizeIp')) {
    /**
     * Anonymize IPv4 and IPv6 Ips.
     *
     * @param string $ip
     *
     * @return string
     */
    function anonymizeIp(string $ip): string
    {
        if (str_contains($ip, '.')) {
            return (string) preg_replace(
                '/\.\d*$/',
                '.XXX',
                $ip
            );
        }

        return strrev(last(explode(':', strrev($ip), 3))) . ':XXXX' . ':XXXX';
    }
}

if (!function_exists('getFormattedHeaders')) {
    /**
     * Get formatted headers from Request or HeaderBag.
     *
     * @param \Symfony\Component\HttpFoundation\HeaderBag|\Illuminate\Http\Request $headerBag
     *
     * @return array
     */
    function getFormattedHeaders(HeaderBag|Request $headerBag): array
    {
        if ($headerBag instanceof Request) {
            $headerBag = $headerBag->headers;
        }

        return array_map(
            fn ($header) => $headerBag->get($header),
            array_combine($headerBag->keys(), $headerBag->keys())
        );
    }
}
