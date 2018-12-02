<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
class AdminController extends Controller
{
    //
    public function article()
    {
        return view('admin.article');
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
}
