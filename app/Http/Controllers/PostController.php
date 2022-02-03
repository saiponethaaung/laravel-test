<?php

namespace App\Http\Controllers;

use App\Http\Requests\V1\PostReactionRequest;
use App\Models\Like;
use App\Models\Post;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::get();

        $data = [];

        foreach ($posts as $post) {
            $data[] = $post->convertResult();
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    public function toggleReaction(PostReactionRequest $request)
    {
        if ($request->like) {
            Like::create([
                'post_id' => $request->post_id,
                'user_id' => auth()->id()
            ]);
        } else {
            Like::where([
                'post_id' => $request->post_id,
                'user_id' => auth()->id()
            ])->delete();
        }

        return response()->json([
            'status' => 200,
            'message' => 'You ' . ($request->like ? 'like' : 'unlike') . ' this post successfully'
        ]);
    }
}
