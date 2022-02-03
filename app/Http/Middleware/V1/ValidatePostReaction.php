<?php

namespace App\Http\Middleware\V1;

use App\Models\Like;
use App\Models\Post;
use Closure;
use Illuminate\Http\Request;

class ValidatePostReaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::find($request->post_id);

        if ($post->author_id == auth()->id()) {
            return response()->json([
                'status' => 500,
                'message' => 'You cannot like your post'
            ], 500);
        }

        $like = Like::where('post_id', $request->post_id)->where('user_id', auth()->id())->first();

        if ($like && $request->like) {
            return response()->json([
                'status' => 500,
                'message' => 'You already liked this post'
            ], 500);
        }

        if (empty($like) && !$request->like) {
            return response()->json([
                'status' => 200,
                'message' => 'You already unlike this post'
            ]);
        }

        return $next($request);
    }
}
