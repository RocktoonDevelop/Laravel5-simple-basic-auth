<?php

namespace RocktoonDevelop\SimpleBasicAuth\Http\Middleware;

use Closure;


class SimpleBasicAuth {

    public function handle($request, Closure $next) {

        $simple_basic_auth_users = config('simple_basic_auth.users');

        if (!isset($simple_basic_auth_users[$request->getUser()]) || $simple_basic_auth_users[$request->getUser()] != $request->getPassword()) {
            $header = ['WWW-Authenticate' => 'Basic'];

            return response('Authenticated error.', 401, $header);
        }

        return $next($request);
    }
}
