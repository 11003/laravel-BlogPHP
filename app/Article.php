<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
class Article extends Model
{
    //
    protected $guarded = []; /*可以注入所有字段*/
    public function tag()
    {
        return $this->belongsToMany(
            Tag::class,
            'article_tag',
            'article_id',
            'tag_id'
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public static function getHotArticle()
    {
        $article = Cache::remember('hot_article',5,function(){
            $article = self::limit(4)
                ->select(['title','desc','cover','content','book_id','user_id','id'])
                ->get();
            return $article;
        });
        return $article;
    }
}
