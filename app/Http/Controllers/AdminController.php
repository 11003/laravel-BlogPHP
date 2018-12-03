<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Tag;
use App\Article;
class AdminController extends Controller
{
    //
    public function article()
    {
        $articles = Article::paginate(10);
        return view('admin.article',compact('articles'));
    }
    public function book()
    {
        $books = Book::withTrashed()->paginate(10);
        return view('admin.book',compact('books'));
    }
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.index',compact('users'));
    }
    public function tag()
    {
        return view('admin.tag');
    }
    //设为管理员
    public function setAdmin($id,$is_admin)
    {
        $user = User::find($id);
        switch ($is_admin){
            case 1:
                $user->is_admin = $is_admin;
                break;
            default:
                $user->is_admin = 0;
                break;
        }
        $user->save();

        return ['msg'=>'修改用户权限成功','status'=>1];
    }
    //禁用用户
    public function setDisable($id,$is_disable)
    {
        $user = User::find($id);
        switch ($is_disable){
            case 1:
                $user->is_disable = $is_disable;
                break;
            default:
                $user->is_disable = 0;
                break;
        }
        $user->save();
        return ['msg'=>'修改用户状态成功','status'=>1];
    }
}
