<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Book;
class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hot_books = Book::getHotBooks();
        $hot_articles = Article::getHotArticle();
        return view('welcome',compact('hot_books','hot_articles'));
    }
}
