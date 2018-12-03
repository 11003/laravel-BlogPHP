@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <h2 class="ui dividing header">添加新的标签</h2>
        <form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ url('tag/store') }}" method="POST" enctype="multipart/form-data">
            <div class="ui grid">
                <div class="four twelve computer column">
                    {{ csrf_field() }}
                    @include('common.formmessage')
                    <div class="ui error message">
                    </div>
                    <div class="field">
                        <label>标签名称</label>
                        <input type="text" value="{{ old('tag_name') }}" name="tag_name">
                    </div>
                    <div class="field">
                        <label>标签描述</label>
                        <textarea name="desc" cols="30" rows="10">{{ old('desc') }}</textarea>
                    </div>
                    <button class="ui green button" type="submit">确认添加</button>
                    <a class="ui red button" href="{{ url('admin/tag') }}">返回</a>
                </div>
            </div>
        </form>
    </div>
@endsection