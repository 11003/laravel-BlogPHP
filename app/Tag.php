<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $guarded = []; /*可以注入所有字段*/
    public function article()
    {
        return $this->belongsToMany(
            Article::class,
            'article_tag',
            'tag_id',
            'article_id'
        );
    }
    public function status()
    {
        return $this->status === 1;
    }

}
