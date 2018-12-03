@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                @include('common.adminmenu')
            </div>
            <div class="twelve wide stretched column">
                <a href="{{ url('tag/create') }}" class="ui green basic button">新增标签</a>
                <table class="ui celled table">
                    <thead>
                    <tr>
                        <th>标签名称</th>
                        <th>标签描述</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $k => $v)
                    <tr>
                        <td>{{ $v->tag_name }}</td>
                        <td>{{ $v->desc }}</td>
                        <td>{{ $v->created_at }}</td>
                        <td>
                            <a href="javascript:delModel('{{ url('tag/destroy', $v->id) }}')">删除</a>
                            @if($v->status())
                                <a href="javascript:setStatus('{{ url('tag/status', ['id' => $v->id, 'status' => 0]) }}')">取消</a>
                            @else
                                <a href="javascript:setStatus('{{ url('tag/status', ['id' => $v->id, 'status' => 1]) }}')">发布</a>
                            @endif
                            <a href="{{ url('tag/edit', $v->id) }}">修改</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
<script>
    function delModel(url)
    {
        if(confirm('你确定要删除吗?')){
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
    function setStatus(url)
    {
        $.ajax({
            url: url,
            type: "GET",
            success: function (res) {
                if(res.status == 1){
                    alert('标签已发布');
                    window.location.reload();
                }else{
                    alert('标签已取消');
                    window.location.reload();
                }
            },
            dataType: "json"
        })
    }
</script>
@endsection