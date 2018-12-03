@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <h2 class="ui dividing header">修改标签</h2>
        @include('common.formmessage')
        <form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ url('tag/update' ,['id' => $tag->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="ui grid">
                <div class="four twelve computer column">
                    {{ csrf_field() }}
                    <div class="ui error message">
                    </div>
                    <div class="field">
                        <label>标签名称</label>
                        <input type="text" value="{{ $tag->tag_name }}" name="tag_name">
                    </div>
                    <div class="field">
                        <label>标签描述</label>
                        <textarea name="desc" cols="30" rows="10">{{ $tag->desc }}</textarea>
                    </div>
                    <input type="hidden" value="{{ $tag->id }}" name="id">
                    <button class="ui green button" type="submit">确认修改</button>
                    <a class="ui red button" href="javascript:history.back(-1)">返回</a>
                </div>
            </div>
        </form>
    </div>
@endsection