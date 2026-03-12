<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPostViews
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->route('post') instanceof \App\Models\Post) {
            $post = $request->route('post');
            $sessionKey = 'viewed_post_' . $post->id;
            if (!session()->has($sessionKey)) {
                $post->incrementViews();
                session()->put($sessionKey, true);
            }
        }

        return $response;
    }
}
