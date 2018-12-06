<div class="ui vertical fluid right tabular menu">
    <a class="item {{ active_class(if_uri('user/index')) }}" href="{{ url('user/index') }}">个人信息 </a>
    <a class="item {{ active_class(if_uri('noti')) }}" href="{{ url('noti') }}">消息中心
        @php($unread_count = Auth::user()->unreadNotifications()->count())
        @if($unread_count > 0)
        <div class="ui red circular label">
            {{ $unread_count }}
        </div>
        @endif
    </a>
    <a class="item " href="{{ url('password') }}">密码修改 </a>
</div>