<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookValidateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Book;
class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::orderBy('created_at','desc')->withCount('article')->paginate(10);
        return view('book.index', compact('books'));
    }

    public function create()
    {
        return view('book.create');
    }
    public function store(BookValidateRequest $request)
    {
        //only只会接收数组里面的值,其他的值不接收
        $data = $request->only([
            'title','author','desc','cover','content'
        ]);
        if($request->file('cover')){
            $cover = Storage::putFile('/public/book',$request->file('cover'));
            $data['cover'] = Storage::url($cover);
        }
        Book::create($data);
        return back()->with('success','新增图书成功');
    }
    public function show($id)
    {
        $book = Book::withCount('article')->findOrFail($id);
        return view('book.show',compact('book'));
    }
    public function edit($id)
    {
        $book = Book::withCount('article')->findOrFail($id);
        return view('book.edit',compact('book'));
    }
    public function update(BookValidateRequest $request,$id)
    {

    }
    public function destroy($id)
    {
        //查看已删除的字段 withTrashed【注意：必须要在数据迁移定义软删除  $table->softDeletes();
        /*判断是否已删除
        "return Boolean"
        Book::withTrashed()->find(1);
        dd($book->trashed())查看已删除的数据
        dd($book->restore())恢复
        dd($book->forceDelete())彻底删除*/
        Book::find($id)->delete();
        return ['status'=>1,'msg'=>'ok'];
//        Book::withTrashed()->find($id);
    }

    //恢复被删除的数据
    public function restore($id)
    {
        Book::withTrashed()->findOrFail($id)->restore();
        return ['status'=>1,'msg'=>'ok'];
    }
}
