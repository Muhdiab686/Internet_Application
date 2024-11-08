<?php

namespace App\Repositories;

use App\Interfaces\RegisterRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class RegisterRepository implements RegisterRepositoryInterface
{
    public function create(array $info)
    {
        return User::create($info);
    }

    public function find($email)
    {
        return User::where('email', $email)->exists();
    }

    public function get($email)
    {
        return User::where('email', $email)->get();
    }
    
    public function getuserIn($groupId)
    {
        $currentUserId = auth()->id();
        $groupMemberIds = DB::table('groups_user')
        ->where('groups_id', $groupId)
        ->pluck('user_id');
        return User::whereNotIn('id', $groupMemberIds)
               ->where('id', '!=', $currentUserId)
               ->get();
    }
    public function getuser()
    {
        $currentUserId = auth()->id();
        return User::where('id', '!=', $currentUserId)
               ->get();
    }
}
