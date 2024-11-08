<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Groups;
use App\Models\User;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'group_id',
        'path',
        'user_id',
        'status'
    ];
    public function group()
    {
        return $this->belongsTo(Groups::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
