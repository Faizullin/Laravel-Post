<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table='likes';
    //protected $guarded=false;
    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type,'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function likeable()
    {
        return $this->morphTo();
    }
    public function likeByUser($user_id)
    {
        return $this->where('user_id',$user_id);
    }
}
