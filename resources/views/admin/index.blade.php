@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                @include('common.adminmenu')
            </div>
            <div class="twelve wide stretched column">
                <table class="ui celled table">
                    <thead>
                    <tr>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @if($user->id == 1)
                                <button class="ui button green"
                                        onclick="setUpdate('#')">
                                    修改
                                </button>
                                @else
                                @if($user->is_admin())
                                    <button class="ui button orange"
                                            onclick="setAdmin('{{ url('admin/setAdmin' , ['id' => $user->id, 'is_admin' => 0]) }}')">
                                        取消管理员
                                    </button>
                                    @else
                                    <button class="ui button green"
                                            onclick="setAdmin('{{ url('admin/setAdmin' , ['id' => $user->id, 'is_admin' => 1]) }}')">
                                        设为管理员
                                    </button>
                                @endif

                                @if($user->is_disable())
                                    <button class="ui button green"
                                            onclick="setDisable('{{ url('admin/setDisable', ['id' => $user->id ,'is_disable' => 1]) }}')">
                                        恢复此用户
                                    </button>
                                    @else
                                    <button class="ui button red"
                                            onclick="setDisable('{{ url('admin/setDisable', ['id' => $user->id ,'is_disable' => 0]) }}')">
                                        禁用此用户
                                    </button>
                                @endif


                            @endif
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4">
                            {{ $users->links('vendor.pagination.semantic-ui') }}
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
    function setAdmin(url)
    {
        $.ajax({
            url:url,
            type: "GET",
            dataType: "json",
            success: function (res) {
                alert(res.msg);
                window.location.reload();
            },
        })
    }
    function setDisable(url)
    {
        $.ajax({
            url:url,
            type: "GET",
            dataType: "json",
            success: function (res) {
                alert(res.msg);
                window.location.reload();
            },
        })
    }
</script>
@endsection