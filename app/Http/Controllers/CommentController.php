<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class CommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
        $comments = Post::find($id)->comments()->orderBy('created_at', 'desc')->paginate(10);
        
        return $this->sendResponse(CommentResource::collection($comments), 'Comments fetched');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validation = Validator::make($request->all(),
                [
                    'post_id' => 'required',
                    'comment' => 'required',
                ]);

            if($validation->fails()){
                return $this->sendError('Validation error.', $validation->errors());
            }

            $comment = Comment::create(array_merge(
                $request->all(),
                [
                    'user_id' => auth()->id(),
                ]
            ));

            return $this->sendResponse(new CommentResource($comment), 'Post created.');

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
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
