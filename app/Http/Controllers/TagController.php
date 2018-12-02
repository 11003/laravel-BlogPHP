<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagValidateRequest;
use Illuminate\Http\Request;
use App\Tag;
class TagController extends Controller
{
    //
    public function create()
    {
        return view('tag.create');
    }
    public function store(TagValidateRequest $request)
    {
        $this->validate(request(),[
            'tag_name' => 'required|string|max:3|min:2|unique:tags',
            'desc' => 'required|string'
        ]);
        $data = $request->all();
        $create_data = [
            'tag_name' => $data['tag_name'],
            'desc'  => $data['desc']
        ];
        Tag::create($create_data);
        return back()->with('success','添加标签成功');
    }
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tag.edit',compact('tag'));
    }
    public function update(TagValidateRequest $request,$id)
    {
        $article = Tag::findOrFail($id);
        $data = $request->all();
        $article->update($data);
        return back()->with('success', '成功更新标签信息');
    }
}
