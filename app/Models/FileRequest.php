<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Groups;
use App\Models\User;
class FileRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'user_id',
        'file_path',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Groups::class);
    }
}
