@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                @include('common.adminmenu')
            </div>
            <div class="twelve wide stretched column">
                <a class="ui green basic button" href="{{ url('book/create') }}">新增图书</a>
                <table class="ui celled table">
                    <thead>
                    <tr>
                        <th>书名</th>
                        <th>作者</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            @if(empty($book->deleted_at))
                                <div class="ui green horizontal label">正常</div>
                                @else
                                <div class="ui red horizontal label">删除</div>
                            @endif
                        </td>
                        <td>{{ $book->created_at }}</td>
                        <td>
                            {{--判断是否删除trashed--}}
                            @if($book->trashed())
                                <a href="javascript:restoreModel('{{ url('book/restore', $book->id) }}')">恢复</a>
                            @else
                                <a href="javascript:delModel('{{ url('book/del', $book->id) }}')">删除</a>
                            @endif
                            <a href="{{ url('book/edit', $book->id) }}">修改</a>
                            <a href="{{ url('article/create', $book->id) }}">添加文摘</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5">
                            {{ $books->links('vendor.pagination.semantic-ui') }}
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    <script>
        $('.dropdown').dropdown();

        // 删除模型
        function delModel(url) {
            if(confirm("你确定要删除吗?")){
                $.ajax({
                    url: url,
                    type: "DELETE",
                    success: function () {
                        window.location.reload();
                    },
                    dataType: "json"
                })
            }

        }

        // 恢复模型
        function restoreModel(url) {
            $.ajax({
                url: url,
                type: "POST",
                success: function () {
                    window.location.reload();
                },
                dataType: "json"
            })
        }
    </script>
@endsection