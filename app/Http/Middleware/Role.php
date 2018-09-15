<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    protected $level = [
        'admin'  => 1,
        'client' => 2,
        'guest'  => 3
        ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        $user = auth()->user();
        if($this->level[$user->role] > $this->level[$role]){
            abort(401);
        }
        return $next($request);
    }

    protected function level()
    {
        return ['admin'=> 1,'client'=>2];
    }
}
