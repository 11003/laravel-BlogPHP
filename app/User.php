<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable; //系统自动加的,接收消息的模型

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cover', 'desc', 'comment_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function article()
    {
        return $this->hasMany(Article::class);
    }
    public function is_admin()
    {
        return $this->is_admin === 1;
    }

    //用户使用状态
    public function is_disable()
    {
        return $this->is_disable === 1;
    }
}
