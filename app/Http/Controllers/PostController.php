<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
