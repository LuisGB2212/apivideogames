<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TransformInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $transformer)
    {
        $transformedInputs = [];

        // foreach input get its original attribute
        foreach($request->request->all() as $input => $value)
        {
            $transformedInputs[$transformer::originalAttribute($input)] = $value;
        }

        // replace inputs by its original attribute
        $request->replace($transformedInputs);

        return $next($request);
    }
}
