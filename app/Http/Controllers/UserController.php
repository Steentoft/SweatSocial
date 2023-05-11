<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;

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
            if(strrpos($th->getMessage(), "users_username_unique")) $message = "Must use a unique username";
            else if(strrpos($th->getMessage(), "users_email_unique")) $message = "Must use a unique email";
            return response()->json([
                'success' => false,
                'message' => $message
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
