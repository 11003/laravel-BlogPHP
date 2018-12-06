<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Comment extends Model
{
    //
    protected $fillable = [
        'content',
        'user_id',
        'reply_user_id',
        'article_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reply_user()
    {
        return $this->belongsTo(User::class);
    }
    //人性化时间显示  get【UserName】Attribute
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}
