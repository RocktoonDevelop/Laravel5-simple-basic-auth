<?php

namespace RocktoonDevelop\SimpleBasicAuth\Http\Middleware;

use Closure;


class SimpleBasicAuth {

    public function handle($request, Closure $next) {

        $simple_basic_users = config('simple_basic.users');

        return $next($request);
    }
}
