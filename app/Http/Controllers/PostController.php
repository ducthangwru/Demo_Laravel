<?php

namespace App\Http\Controllers;

use App\Models\Post as Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function findOne($id) {
        $post = Post::find($id);
        return response()
            ->json($post->toArray());
    }
}
