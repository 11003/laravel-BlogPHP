@extends('common.layout')

@section('page_content')
    <div class="ui container">
        <h2 class="ui dividing header">添加新的文摘</h2>

        <form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ url('article/store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="ui grid">
                <div class="four wide computer column">
                    <input type="file" name="cover" class="dropify" data-default-file=""
                           data-allowed-file-extensions="jpg png jpeg"/>
                </div>
                <div class="twelve wide computer column">
                    @include('common.formmessage')
                    <div class="two fields">
                        <div class="field">
                            <label>文摘名称</label>
                            <input type="text" value="{{ old('title') }}" name="title" placeholder="请输入图书名称">
                        </div>
                        <div class="field">
                            <label>文摘标签</label>
                            <select name="tags[]" class="ui selection dropdown" multiple="" id="multi-select">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label>文摘简介</label>
                        <textarea rows="4" name="desc">{{ old('desc') }}</textarea>
                    </div>
                    <div class="field">
                        <div id="editor">
                            <p></p>
                        </div>
                    </div>
                    <textarea name="content" id="content" style="display: none">{{ old('content') }}</textarea>
                    <input type="hidden" name="book_id" value="{{ $book_id }}">
                    <button class="ui green button" type="submit">确认发布</button>
                    <a class="ui red button" href="javascript:history.back()">返回</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('page_script')
    <script src="/js/components/dropdown.js"></script>
    <script src="/js/dropify.min.js"></script>
    <script src="/js/wangEditor.min.js"></script>

    <script>
        $(function () {
            $('#multi-select').dropdown({
                maxSelections: 3,
                placeholder: '选择合适的标签'
            });
            $('.dropify').dropify({
                messages: {
                    'default': '在这里上传文摘封面',
                    'replace': '在这里替换新的文摘封面',
                    'remove': '删除',
                    'error': '哦噢，出错啦'
                }
            });
            var E = window.wangEditor;
            var editor = new E('#editor');
            var $content = $('#content');
            editor.customConfig.onchange = function (html) {
                // 监控变化，同步更新到 textarea
                $content.val(html);
            };
            editor.customConfig.zIndex = 2;
            editor.create();
            $content.val(editor.txt.html())
        })
    </script>
@endsection

@section('page_style')
    <link rel="stylesheet" href="/css/dropify.min.css">
    <link rel="stylesheet" href="/css/wangEditor.min.css">
    <link rel="stylesheet" href="/js/components/dropdown.min.css">
@endsection