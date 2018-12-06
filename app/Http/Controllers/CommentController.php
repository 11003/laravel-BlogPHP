<?php

namespace App\Http\Controllers;

use App\Article;
use App\Events\ReplyEvent;
use App\Notifications\CommentNotification;
use App\Notifications\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'content',
            'article_id',
            'reply_user_id'
        ]);

        $user = Auth::user();
        $data['user_id'] = $user->id;
        $article = Article::find($request->article_id);
        $article->comment()->create($data);

        // 发送消息
        $article->user
            ->notify(new ReplyComment([
                'user_name' => $user->name,
                'title' => $article->title,
                'content' => $data['content']
            ]));

        // 触发事件 $user = Auth::user();
        event(new ReplyEvent($user));

        return back()->with('success', '成功发送评论');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
