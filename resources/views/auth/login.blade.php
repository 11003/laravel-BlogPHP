@extends('common.layout')

@section('page_content')
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui teal image header">
                <div class="content">
                    登录书屋
                </div>
            </h2>
            <form class="ui large form {{ $errors->any() ? 'error' : '' }}" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="email" placeholder="E-mail 地址">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="密码">
                        </div>
                    </div>
                    <button type="submit" class="ui fluid large teal submit button">
                        登录
                    </button>
                </div>
                @include('common.formmessage')
            </form>
            <div class="ui message">
                还没有账号？ <a href="{{ url('register') }}">注册一个</a>
            </div>
        </div>
    </div>
@endsection

@section('page_style')
    <style type="text/css">
        body {
            background-color: #DADADA;
        }
        body > .grid {
            height: 100%;
        }
        .column {
            max-width: 450px;
        }
    </style>
@endsection