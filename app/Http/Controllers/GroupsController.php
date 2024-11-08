<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateGroupsRequest;
use Illuminate\Http\Request;
use App\Services\GroupsService;
class GroupsController extends Controller
{
    protected $GrobeService;
    
    public function __construct(GroupsService $GrobeService)
    {
        $this->GrobeService = $GrobeService;
    }

    public function createGroup(CreateGroupsRequest $request)
    {
        return $this->GrobeService->createGroup($request);  
    }
    public function getGroups()
    {
        return $this->GrobeService->getGroups();  
    }

    public function getGroupFiles($groupId)
    {
        return $this->GrobeService->getGroupFiles($groupId);  
    }

    public function inviteMember(Request $request, $groupId)
    {
        return $this->GrobeService->inviteMember($request,$groupId);
    }
}
