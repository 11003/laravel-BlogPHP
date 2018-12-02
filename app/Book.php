<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model
{
    use SoftDeletes;//因为数据库添加了软删除delete_at 所以这里要定义一下
    protected $guarded = []; /*可以注入所有字段*/
    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
