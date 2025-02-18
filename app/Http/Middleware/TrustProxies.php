<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request; // Gunakan Symfony untuk HTTP request

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * Indicates whether the proxy should be trusted.
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR;
}
