<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=false;
    protected $table='comments';
    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');;
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
    public function likes()
    {
      return $this->morphMany(Like::class,'likeable');
    }
}
