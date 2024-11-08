<?php

namespace App\Repositories;

use App\Interfaces\GroupRepositoryInterface;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;

class GroupRepository implements GroupRepositoryInterface
{
    public function create(array $info)
    {
        $group = new Groups();
        $group->name = $info['name'];
        $group->creator_id = $info['creator_id'];
        $group->save();

        if (isset($info['members'])) {
            $group->members()->attach($info['members']);;
        }
        return $group;
    }
    public function getgroups()
    {
        $groups =  Groups::with('creator')
        ->withCount('members')
        ->get();
        return $groups->map(function ($group) {
            return [
                'group_name' => $group->name,
                'owner' => $group->creator->name,
                'members_count' => $group->members_count,
            ];
        });
    }

}
