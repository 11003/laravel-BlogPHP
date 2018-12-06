<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        if($user == null){
            return redirect('/');
        }
        return view('user.index',compact('user'));
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
        //
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
    public function update(UserUpdateRequest $request, $id)
    {
        //
        $user = Auth::user($id);
        $data = [
            'name' => $request->name,
            'desc' => $request->desc
        ];
        if($request->file('avatar')){
            $cover = Storage::putFile('/public/avatar',$request->file('avatar'));
            $data['cover'] = Storage::url($cover);
        }
        $user->update($data);
        return back()->with('success', '更新用户信息成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function noti()
    {
        //获取用户已读和未读消息
        $notis = Auth::user()->notifications()->paginate(10);
        return view('user.noti',compact('notis'));
    }
    public function readall()
    {
        Auth::user()
            ->unreadNotifications //获取未读消息
            ->markAsRead(); //改为已读
        return back()->with('success','已将未读消息标记为已读');
    }
    public function notreadall()
    {
        Auth::user()
            ->readNotifications //获取已读消息
            ->markAsUnread(); //改为未读
        return back()->with('success','已将已读消息标记为未读');
    }
    public function delread()
    {
        Auth::user()
            ->readNotifications //获取已读消息
            ->delete(); //改为已读
        return back()->with('success','已将所有已读消息删除');
    }
    public function destroy($id)
    {
        //
    }
}
