<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return auth()->user();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        try {
            $user->update($request->all());
            return $user;
        } catch (\Throwable $th) {
            $message = "An error occured";
            if (strrpos($th->getMessage(), "users_username_unique")) {
                $message = "Must use a unique username";
            } elseif (strrpos($th->getMessage(), "users_email_unique")) {
                    $message = "Must use a unique email";
            }
            return response()->json([
                'success' => false,
                'message' => $message
            ], 500);
        }
    }
    public function uploadPicture(Request $request)
    {
        try{
            $request->validate(["image" => "image|mimes:jpeg,png,jpg"]);

           /* if($validation->fails()){
                return $this->sendError('Validation error.', $validation->errors());
            }*/
            $user = User::find(auth()->user()->id);
            $image = $request->file('image');
            $path = $image->store('public');
            $user->profile_image_path = $path;
            $user->save();
            return $user;

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function getPicture(Request $request, string $id)
    {
        try
        {
            $user = User::find($id);
            return response()->file($user->profile_image_path);
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
    public function destroy(string $id)
    {
        //
    }
}
