@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                @include('common.usermenu')
            </div>
            <div class="twelve wide stretched column">
                <div class="twelve wide stretched column">
                    @include('common.formmessage')
                    <table class="ui compact celled definition table">
                        <thead class="full-width">
                        <tr>
                            <th>
                                消息状态
                            </th>
                            <th>
                                消息内容
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($notis as $k=>$v)
                            <tr>
                                <td>
                                    {{ empty($v->read_at) ? '未读' : '已读' }}
                                </td>
                                <td>
                                    {{ $v->data['user_name'] }} 在您发布的文章《{{ $v->data['title'] }}》 中发布了评论: {{ $v->data['content'] }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="2">
                                    <p style="text-align:center; padding: 20px">
                                        还没有信息
                                    </p>
                                </th>
                            </tr>
                        @endforelse

                        </tbody>
                        <tfoot class="full-width">
                        <tr>
                            <th colspan="2">
                                <a href="{{ url('noti/readall') }}" class="ui small button">
                                    标记所有为已读
                                </a>
                                <a href="{{ url('noti/notreadall') }}" class="ui small button">
                                    标记所有为未读
                                </a>
                                <a href="{{ url('noti/delread') }}" class="ui small button red right floated">
                                    删除所有已读消息
                                </a>
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection