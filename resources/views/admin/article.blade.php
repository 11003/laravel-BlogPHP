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
                        <th>
                            文章标题
                        </th>
                        <th>
                            作者
                        </th>
                        <th>
                            简介
                        </th>
                        <th>
                            阅读量
                        </th>
                        <th>
                            创建时间
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $k => $v)
                    <tr>
                        <td>
                            {{ $v->title }}
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            {{ $v->desc }}
                        </td>
                        <td>
                            468
                        </td>
                        <td>
                            {{ $v->created_at }}
                        </td>
                        <td>
                            <a href="{{ url('article/del', ['aid'=> $v->id]) }}">删除</a>
                            <a href="{{ url('article/edit', ['aid'=> $v->id]) }}">修改</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="6">
                            <div class="ui pagination menu" role="navigation">
                                {{ $articles->links('vendor.pagination.semantic-ui') }}
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection