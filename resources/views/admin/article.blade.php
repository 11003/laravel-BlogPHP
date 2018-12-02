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
                    <tr>
                        <td>
                            deleniti hic sit quia cumque
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Labore ut ut assumenda consectetur fugiat sunt sint.
                        </td>
                        <td>
                            226
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            unde nam fuga maxime odio
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Tempore eum quaerat est optio itaque.
                        </td>
                        <td>
                            168
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            tempora iure rerum praesentium a
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Ut doloribus totam eligendi cum qui quaerat optio.
                        </td>
                        <td>
                            377
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            a saepe qui libero soluta
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Dicta odio aperiam fugit accusantium.
                        </td>
                        <td>
                            290
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            sed sit cumque temporibus provident
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Asperiores magni dolores eum.
                        </td>
                        <td>
                            291
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            fuga rerum similique ut atque
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Delectus aperiam odit in ex sed.
                        </td>
                        <td>
                            417
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            voluptas magni voluptate optio sed
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Quod sit repellat ut molestiae.
                        </td>
                        <td>
                            212
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            commodi ipsum deleniti iure porro
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Atque et quia qui.
                        </td>
                        <td>
                            282
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            aut quo a perferendis et
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Perspiciatis quidem sed voluptatem quia.
                        </td>
                        <td>
                            125
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            deserunt aut ipsa similique et
                        </td>
                        <td>
                            admin
                        </td>
                        <td>
                            Minima aut soluta asperiores et ullam sunt consequatur.
                        </td>
                        <td>
                            468
                        </td>
                        <td>
                            2018-05-13 15:01:51
                        </td>
                        <td>
                            <a href="#">删除</a><a href="#">修改</a>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="6">
                            <div class="ui pagination menu" role="navigation">
                                <a class="icon item disabled" aria-disabled="true" aria-label="&laquo; 上一页"><i
                                            class="left chevron icon"></i></a><a class="item active" href="#"
                                                                                 aria-current="page">1</a><a class="item"
                                                                                                             href="#">2</a><a
                                        class="item" href="#">3</a><a class="item" href="#">4</a><a class="item"
                                                                                                    href="#">5</a><a
                                        class="item" href="#">6</a><a class="item" href="#">7</a><a class="item"
                                                                                                    href="#">8</a><a
                                        class="icon item disabled" aria-disabled="true">...</a><a class="item"
                                                                                                  href="#">29</a><a
                                        class="item" href="#">30</a><a class="icon item" href="#" rel="next"
                                                                       aria-label="下一页 &raquo;"><i
                                            class="right chevron icon"></i></a>
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection