<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = []; /*可以注入所有字段*/

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
