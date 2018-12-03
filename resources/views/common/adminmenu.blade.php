<div class="ui vertical fluid right tabular menu">
    <a class="item {{ active_class(if_uri('admin')) }}" href="{{ url('admin') }}">用户管理 </a>
    <a class="item {{ active_class(if_uri('admin/book')) }}" href="{{ url('admin/book') }}">图书管理 </a>
    <a class="item {{ active_class(if_uri('admin/article')) }}" href="{{ url('admin/article') }}">文摘管理 </a>
    <a class="item {{ active_class(if_uri('admin/tag')) }}" href="{{ url('admin/tag') }}">标签管理 </a>
</div>