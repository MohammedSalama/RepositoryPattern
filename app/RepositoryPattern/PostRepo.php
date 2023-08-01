<?php

namespace RepositoryPattern;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class PostRepo implements Repo
{

    public function store($request) {
        try {

            DB::beginTransaction();
            $data = $request->except('photos');
            $data['user_id'] = auth()->id();
            $post = Post::create($data);
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $uploadPhoto) {
                    $photo = new PostPhoto();
                    $photo->post_id = $post->id;
                    $photo->photo = 'app/' . $uploadPhoto->store('posts');
                    $photo->save();
                }
            }
            DB::commit();
            return response()->json([
                "data" => $post,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

    }
    public function getOne($id) {
        //
    }
    public function all() {
        $posts = Post::get();
        return response()->json(PostResource::collection($posts));
    }
}
