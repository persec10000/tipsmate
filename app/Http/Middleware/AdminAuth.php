<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
{
    public function handle($request, Closure $next) {
        $admin_check = $request->session()->get("admin");

        if ($admin_check == NULL) {
            return redirect()->route('admin-login');
        }
        return $next($request);
    }



}
