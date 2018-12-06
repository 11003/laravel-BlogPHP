<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class Book extends Model
{
    use SoftDeletes;//因为数据库添加了软删除delete_at 所以这里要定义一下
    protected $guarded = []; /*可以注入所有字段*/
    public function article()
    {
        return $this->hasMany(Article::class);
    }
    public static function getHotBooks()
    {
//        if(Cache::has('hot_books')){
//            return Cache::get('hot_books');
//        }
//        *******************
//        Cache::put('hot_books',$book,3);
        $book = Cache::remember('hot_books',5,function(){
            $book_ids = Article::select(DB::raw('count(*) as article_count, book_id'))
                ->whereNotNull('book_id')
                ->groupBy('book_id')
                ->orderBy('article_count','DESC')
                ->limit(4)
                ->get()
                ->pluck('book_id');//pluck 以其中值整合

            $book = self::whereIn('id',$book_ids)
                ->select(['title','desc','cover','content']) //尽量做到需要什么字段缓存什么字段，不用缓存整个模块
                ->withCount('article')
                ->get();
            return $book;
        });
        return $book;
    }
}
