<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupInviteResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\PostResource;
use App\Models\Group;
use App\Models\GroupMember;
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

        $groups = GroupMember::where('user_id', $user->id)->where('invited', 0)->get();

        return GroupInviteResource::collection($groups);
    }

    /**
     * Display a listing of the resource.
     */
    public function invitations()
    {
        $user = User::find(auth()->user()->id);

        $invitations = GroupMember::where('user_id', $user->id)->where('invited', 1)->get();

        return GroupInviteResource::collection($invitations);
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
        if (!$group->group_owner_id = auth()->user()->id){
            return $this->sendError('You are not the owner of the requested resource.', 'Unauthenticated.');
        }

        try {

            $validation = Validator::make($request->all(),
                [
                    'group_name' => 'required',
                ]);

            if($validation->fails()){
                return $this->sendError('Validation error.', $validation->errors());
            }

            $group->update($request->all());
            $group->save();

            return $this->sendResponse($group, 'Group updated.');

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
    public function invite(Request $request, Group $group)
    {
        if (!$group->members->contains(auth()->user()->id)){
            return $this->sendError('You are not a member of the requested resource.', 'Unauthenticated.');
        }

        try {

            $validation = Validator::make($request->all(),
            [
                'username' => 'required|exists:users,username',
            ]);

            if($validation->fails()){
                return $this->sendError('Validation error.', $validation->errors());
            }

            $member = GroupMember::upsert(
                [
                    ['group_id' => $group->id, 'user_id' => User::where('username', $request->get('username'))->first()->id, 'invited' => 1]
                ],
                ['group_id', 'user_id'],
                ['invited']
            );

            return $this->sendResponse($member, 'Invite sent.');

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
    public function destroy(Group $group)
    {
        if (!$group->group_owner_id = auth()->user()->id){
            return $this->sendError('You are not the owner of the requested resource.', 'Unauthenticated.');
        }

        try {

            $group->members()->detach();
            $group->posts()->delete();
            $group->delete();

            return $this->sendResponse(true, 'Group deleted.');

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
