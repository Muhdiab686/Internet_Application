<?php

namespace App\Services;

use App\Http\Requests\CreateGroupsRequest;
use App\Http\Requests\InviteMemberToGroupsRequest;
use App\Models\Groups;
use App\Interfaces\GroupRepositoryInterface;

class GroupsService
{
    protected $GroupRepository;
    public function __construct( GroupRepositoryInterface  $GroupRepository) 
    {
        $this->GroupRepository = $GroupRepository;
    }

    public function createGroup(CreateGroupsRequest $request)
    {
        $data = [
            'name' => $request['name'],
            'creator_id' => auth()->id(),
            'members' => $request['members'] ?? []
        ];
        $this->GroupRepository->create($data);
        return response()->json(['message' => 'Group created successfully']);
    }

    public function getGroups()
    {
    $groups = $this->GroupRepository->getgroups();
    return response()->json(['user' => $groups, 'message' => 'All User in Application'], 200);
    }

    public function getGroupFiles($groupId)
    {
        $group = Groups::with('files')->findOrFail($groupId);
        if (!$group->members->contains(auth()->id()) && $group->creator_id != auth()->id()) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }
        return response()->json($group->files);
    }

    public function inviteMember(InviteMemberToGroupsRequest $request ,$groupId )
    {
        $group = Groups::findOrFail($groupId);
        if ($group->creator_id != auth()->id()) {
            return response()->json(['error' => 'Unauthorized action'], 403);
        }
        $group->members()->attach($request['user_id']);
        return response()->json(['message' => 'Member invited successfully']);
    }
}