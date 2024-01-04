<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
        'comments',
        'tags',
        'dependencies',
        'attachments',
        'created_by'
    ];

    //belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
