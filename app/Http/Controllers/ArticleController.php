<?php

namespace App\Http\Controllers;

use App\Http\Requests\AritcleValidateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Book;
use App\Tag;
use Illuminate\Support\Facades\DB;
class ArticleController extends Controller
{

    //
    public function index()
    {
        $articles = Article::with('tag')
            ->latest()
            ->paginate(5);
        return view('article.index', compact('articles'));
    }
    public function create($book_id)
    {
        $tags = Tag::get();
        //接收book_id
        return view('article.create', compact('book_id','tags'));
    }
    public function store(AritcleValidateRequest $request)
    {
        $data = $request->all();
        $create_data = [
            'title' => $data['title'],
            'desc' => $data['desc'],
            'content' => $data['content'],
            'user_id' =>  Auth::user()->id
        ];
        $file = $request->file('cover');
        if ($file) {
            $cover_path = $file->store('public/article');
            $create_data['cover'] = Storage::url($cover_path);
        }
        //接收tag
        $article = Book::find($data['book_id'])
            ->article()
            ->create($create_data);
        //利用返回值
        $article->tag()->attach($data['tags']);

        return redirect('/article');
    }
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('article.show',compact('article'));
    }
    public function edit($id)
    {
        $tags = Tag::get();
        $article=Article::with('tag')->findOrFail($id);
//        foreach ($article->tag as $tags)
//        {
//            $article_tag[]=$tags->id;
//        }
        $article_tag = $article->tag->pluck('id')->toArray();
        return view('article.edit',compact(
            'article',
            'tags',
            'article_tag'
        ));
    }
    public function update(AritcleValidateRequest $request,$id)
    {
        $article = Article::findOrFail($id);
        $data = $request->only([
            'title',
            'desc',
            'content'
        ]);
        $file = $request->file('cover');
        if ($file) {
            $cover_path = $file->store('public/article');
            $data['cover'] = Storage::url($cover_path);
        }
        $article->update($data);
        //sync 同步关联关系
        $article->tag()->sync($request->tags);
        return back()->with('success', '成功更新文摘信息');
    }
    public function destroy($id)
    {
        Article::find($id)->delete();
        return back()->with('success','删除文摘成功');
    }
}
