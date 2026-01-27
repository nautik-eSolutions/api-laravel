<?php

namespace App\Http\Middleware\persons;

use App\Services\persons\PersonService;
use App\Services\users\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    private PersonService $personService;
    public function __construct()
    {
        $this->personService = new PersonService();
    }

    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route()->parameter('personId');

        if (!$this->personService->show($id)){
            $data = [
                'message'=>"No person was found",
                'status'=>404
            ];
            return response()->json($data,404);
        }

        return $next($request);
    }
}
