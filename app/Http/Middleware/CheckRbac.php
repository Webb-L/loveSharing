<?php

namespace App\Http\Middleware;

use App\Admin\Role;
use Closure;

class CheckRbac
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = \Auth::guard('admin')->user();
        if ($auth->role_id == 0) return $next($request);
        $route = \Route::currentRouteAction();
        $ac = '';
        if(empty($auth->role->auth)) return redirect(route('admin'));
        foreach ($auth->role->auth->auth as $key => $auts) {
            $ac .= $auts->auth_c . '@' . $auts->auth_a . ',';
        }
        $ac .= 'Admin\AdminController@index';
        $routeArr = explode('\\', $route);
        if (strpos($ac, strtolower(end($routeArr))) === false) {
            return redirect(route('admin.error'));
        }
        return $next($request);
    }
}
