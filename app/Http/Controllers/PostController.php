<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\Tag;
use Illuminate\Http\Request;
use Validator;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        return $this->sendResponse(PostResource::collection($posts), 'Posts fetched.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $input = $request->only(['group_id', 'friends_only', 'content', 'linkable_id', 'linkable_type']);
            $input['user_id'] = auth()->user()->id;

            $validation = Validator::make($input,
                [
                    'user_id' => 'required',
                    'content' => 'required',
                    'images' => 'image|mimes:jpeg,png,jpg'
                ]);

            if($validation->fails()){
                return $this->sendError('Validation error.', $validation->errors());
            }

            $post = Post::create($input);

            if ($request->has('tags')){
                $post->tags()->attach(Tag::retrieveTagIds($request->get('tags')));
            }

            if ($request->hasFile('images')){
                Post::attachImages($request->file('images'), $post->id);
            }

            return $this->sendResponse(new PostResource($post), 'Post created.');

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {
        try {
            $post = Post::find($post);

            if ($post){
                return $this->sendResponse(new PostResource($post), 'Post retrieved.');
            } else {
                return $this->sendError('No matching post found.');
            }

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id != $post->user_id){
            return $this->sendError('You are not the owner of the requested resource.', 'Unauthenticated.');
        }

        try {
            $input = $request->only(['content', 'linkable_id', 'linkable_type']);

            $validation = Validator::make($input,
                [
                    'content' => 'required',
                ]);

            if($validation->fails()){
                return $this->sendError('Validation error.', $validation->errors());
            }

            $post->update($input);

            if ($request->has('tags')){
                $post->tags()->attach(Tag::retrieveTagIds($request->get('tags')));
            }

            return $this->sendResponse(new PostResource($post), 'Post created.');

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post)
    {
        $post = Post::find($post);
        if (!$post){
            return $this->sendError('No matching post found.');
        }

        if (auth()->user()->id != $post->user_id){
            return $this->sendError('You are not the owner of the requested resource.', 'Unauthenticated.');
        }

        $post->tags()->detach();
        $post->likes()->detach();
        $post->comments()->delete();
        $post->images()->delete();

        $post->delete();
        return $this->sendResponse([], 'Post deleted.');
    }
}
