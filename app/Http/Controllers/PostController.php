<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(PostResource::collection(Post::all()), 'Posts fetched.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $input = $request->only(['user_id', 'group_id', 'content', 'linkable_id', 'linkable_type']);

            $validation = Validator::make($input,
                [
                    'user_id' => 'required',
                    'content' => 'required',
                ]);

            if($validation->fails()){
                return $this->sendError('Validation error.', $validation->errors());
            }

            $post = Post::create($input);

            return $this->sendResponse($post, 'Post created.');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
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