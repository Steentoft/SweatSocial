<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Http\Resources\PostResource;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class GroupController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);

        return GroupResource::collection($user->groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),
                [
                    'group_name' => 'required',
                ]);

            if($validation->fails()){
                return $this->sendError('Validation error.', $validation->errors());
            }

            $group = Group::create(array_merge(
                $request->all(),
                [
                    'group_owner_id' => auth()->user()->id,
                ]
            ));

            $group->members()->attach(auth()->user()->id);

            return $this->sendResponse(new GroupResource($group), 'Group created.');

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
    public function show(Group $group)
    {
        return new GroupResource($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
