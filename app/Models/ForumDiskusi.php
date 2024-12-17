<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumDiskusi extends Model
{   
    protected $table = "forum_diskusis";
    protected $fillable = ['title', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'forum_id');
    }
}
