@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                @include('common.adminmenu')
            </div>
            <div class="twelve wide stretched column">
                <a href="../tag/add.html" class="ui green basic button">新增标签</a>
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
                    <tr>
                        <td>恐怖</td>
                        <td>恐怖标签的描述</td>
                        <td>2018-05-13 15:02:05</td>
                        <td>
                            <a href="">删除</a>
                            <a href="../tag/edit.html">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>悬疑</td>
                        <td>悬疑标签的描述</td>
                        <td>2018-05-13 15:02:05</td>
                        <td>
                            <a href="#">删除</a>
                            <a href="../tag/edit.html">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>科幻</td>
                        <td>科幻标签的描述</td>
                        <td>2018-05-13 15:02:05</td>
                        <td>
                            <a href="#">删除</a>
                            <a href="../tag/edit.html">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>言情</td>
                        <td>言情标签的描述</td>
                        <td>2018-05-13 15:02:05</td>
                        <td>
                            <a href="#">删除</a>
                            <a href="../tag/edit.html">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>搞笑</td>
                        <td>搞笑标签的描述</td>
                        <td>2018-05-13 15:02:05</td>
                        <td>
                            <a href="#">删除</a>
                            <a href="../tag/edit.html">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>都市</td>
                        <td>都市标签的描述</td>
                        <td>2018-05-13 15:02:05</td>
                        <td>
                            <a href="#">删除</a>
                            <a href="../tag/edit.html">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>盗墓</td>
                        <td>盗墓标签的描述</td>
                        <td>2018-05-13 15:02:05</td>
                        <td>
                            <a href="#">删除</a>
                            <a href="../tag/edit.html">修改</a>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4">

                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection