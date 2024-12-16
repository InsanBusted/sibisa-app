<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = "replies";
    protected $fillable = ['content', 'user_id', 'forum_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function forum()
    {
        return $this->belongsTo(ForumDiskusi::class);
    }
}
