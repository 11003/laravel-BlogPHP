@extends('common.layout')

@section('page_content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                @include('common.usermenu')
            </div>
            <div class="twelve wide stretched column">
                <form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ url('user/update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    @include('common.formmessage')
                    <div class="three fields">
                        <div class="field">
                            <input type="file" name="avatar" class="dropify" data-default-file="{{ $user->cover }}" data-allowed-file-extensions="jpg png jpeg"/>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>用户名</label>
                            <input type="text" name="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="field">
                        <label>个人简介</label>
                        <textarea rows="4" name="desc">{{ $user->desc }}</textarea>
                    </div>
                    <button class="ui green button" type="submit">确认修改</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_style')
    <link rel="stylesheet" href="/css/dropify.min.css">
@endsection

@section('page_script')
    <script src="/js/dropify.min.js"></script>
    <script>
        $('.dropdown').dropdown();
        $('.dropify').dropify({
            messages: {
                'default': '在这里上传您的头像',
                'replace': '在这里替换新的头像',
                'remove':  '删除',
                'error':   '哦噢，出错啦'
            }
        });
    </script>
@endsection