<?php

namespace App\Http\Controllers;

use App\Models\Post as Post;
use App\Traits\Filterable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function findOne($id) {
        $query = Post::find($id);
        $data = $query->get();
        return $this->success($data);
    }

    public function filterPost() {
        $query = new Post();
        $page = request()->has('page') ? request()->get('page') : env('PAGE_DEFAULT');
        $limit = request()->has('limit') ? request()->get('limit') : env('PAGE_LIMIT');

        if (request()->has('content')) {
            $query = $query->where('content', 'LIKE', '%' . request()->get('content') . '%');
        }

        $query = $query->offset($page * $limit)->limit($limit);
        $data = $query->get();
        return $this->success($data);
    }

    public function insertPost() {
        $params = request()->all();
        $data  = [
            'content' => $params['content']
        ];

        $post = new Post();
        $post->fill($data);
        $data = $post->create();
        return $this->success($data);
    }

    public function getHash() {
        $code = '';
        $codeDe = '';

        if(request()->has('code')) {
            $code = Hash::make(request()->get('code'));
        }

        return $this->success($code);
    }
}
