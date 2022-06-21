<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $guarded=false;
    protected $fillable = [
        'title',
        'body',
        'description',
        'category_id',
        'user_id'
    ];
    protected $with = [
      'category',
      'user',
      'tag'
    ];
    public function category()
    {
      return $this->belongsTo(Category::class);
    }
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function tags()
    {
      return $this->belongsToMany(Tag::class,'post_tags',  'post_id','tag_id');
      //return $this->belongsToMany(Tag::class, 'PostTag', 'tag_id', 'post_id');
    }
    public function comments()
    {
      return $this->hasMany(Comment::class,'post_id')->whereNull('parent_id');
    }
    public function likes()
    {
      return $this->morphMany(Like::class,'likeable');
    }
    public function likeByUser($user_id)
    {
      return $this->likes()->where('user_id',$user_id);
    }
}
