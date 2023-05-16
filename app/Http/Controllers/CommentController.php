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
    public function store(Request $request, int $id)
    {
        try {

            $validation = Validator::make(
                $request->all(),
                [
                    'comment' => 'required',
                ]
            );

            if ($validation->fails()) {
                return $this->sendError('Validation error.', $validation->errors());
            }

            $comment = Comment::create(
                array_merge(
                    $request->all(),
                    [
                        'post_id' => $id,
                        'user_id' => auth()->id(),
                    ]
                )
            );

            return $this->sendResponse(new CommentResource($comment), 'Comment added');

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (strrpos($th->getMessage(), "comments_post_id_foreign")) {
                $message = "Post not found";
            }
            return response()->json([
                'success' => false,
                'message' => $message,
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
    public function update(Request $request, $id)
    {
        try {
            $comment = Comment::find($id);
            if (auth()->user()->id != $comment->user_id) {
                return $this->sendError('You are not the owner of the requested resource.', 'Unauthenticated.');
            }
            $validation = Validator::make(
                $request->all(),
                [
                    'comment' => 'required',
                ]
            );

            if ($validation->fails()) {
                return $this->sendError('Validation error.', $validation->errors());
            }
            $comment->update($request->all());
            $comment->save();
            return $this->sendResponse($comment, "Comment updated");
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                //'message' => $th->getMessage(),
                'message' => "The comment does not exist"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return $this->sendError('No matching comment found.');
        }

        if (auth()->user()->id != $comment->user_id) {
            return $this->sendError('You are not the owner of the requested resource.', 'Unauthenticated.');
        }
        $comment->user()->dissociate();

        $comment->delete();
        return $this->sendResponse([], 'Comment deleted.');
    }
}