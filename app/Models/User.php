<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//use App\Notifications\SendVerifyWithQueueNotification;

trait Liker{
    public function likes()
    {
        return $this->hasMany(Like::class,'user_id');
    }

    public function likePost(Post $post,$like)
    {
        return $post->likes()->save(new Like([
            "user_id"=>$this->getKey(),
        ]));
    }
    public function unlikePost(Post $post,$like)
    {
        $like->delete();
        return null;
    }
    public function toggleLikePost(Post $post)
    {
        $like = $post->likeByUser($this->getKey())->first();
        return ($like) ? $this->unlikePost($post,$like) : $this->likePost($post,$like);
    }
}

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Liker;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    const ROLE_READER=0;
    const ROLE_ADMIN=1;
    public function getRoles()
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_READER=>'User'
        ];
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
      return $this->hasMany(Post::class);
    }
    public function likedPosts()
    {
      return $this->belongsToMany(Post::class,'post_user_likes','user_id','post_id');
    }
    public function comments()
    {
      return $this->hasMany(Comment::class,'user_id');
    }
    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new sendEmailVerificationNotification())
    // }

}
