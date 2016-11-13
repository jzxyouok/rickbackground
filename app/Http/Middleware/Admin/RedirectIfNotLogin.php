<?php

namespace App\Http\Middleware\Admin;

use App\Traits\Admin\BasicTrait;
use Closure;

class RedirectIfNotLogin {
	use BasicTrait;

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @param  string|null $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null) {
		if ($request->session()->has($this->adminSessionName)) {
		} else {
			return response()->redirectToRoute('admin.login');
		}
		return $next($request);
	}
}
