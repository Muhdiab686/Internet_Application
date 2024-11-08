<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'creator_id',
    ];
    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function invitations()
    {
        return $this->hasMany(GroupInvitation::class);
    }

    public function fileRequests()
    {
        return $this->hasMany(FileRequest::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
