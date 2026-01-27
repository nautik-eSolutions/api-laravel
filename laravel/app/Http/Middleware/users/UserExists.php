<?php

namespace App\Http\Middleware\users;

use App\Services\users\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route()->parameter('userId');


        if (!$this->userService->show($id)){
            $data = [
                'message'=>"User not found",
                'status'=>404
            ];
            return response()->json($data,404);
        }

        return $next($request);
    }
}
