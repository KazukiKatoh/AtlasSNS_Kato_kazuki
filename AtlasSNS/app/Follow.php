<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['followed_id', 'following_id',];

    public function following()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }

    public function followed()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
