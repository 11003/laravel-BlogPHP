<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('common.head')
</head>
<body>
    @include('common.menu')
    @yield('page_content')
    @include('common.foot')
    @include('common.script')
</body>
</html>