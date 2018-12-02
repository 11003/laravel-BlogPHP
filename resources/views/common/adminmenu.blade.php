<div class="ui vertical fluid right tabular menu">
    <a class="item {{ Request::path() == 'admin' ? 'active' : ''}}" href="{{ url('admin') }}">用户管理 </a>
    <a class="item {{ Request::path() == 'admin/book' ? 'active' : ''}}" href="{{ url('admin/book') }}">图书管理 </a>
    <a class="item {{ Request::path() == 'admin/article' ? 'active' : ''}}" href="{{ url('admin/article') }}">文摘管理 </a>
    <a class="item {{ Request::path() == 'admin/tag' ? 'active' : ''}}" href="{{ url('admin/tag') }}">标签管理 </a>
</div>