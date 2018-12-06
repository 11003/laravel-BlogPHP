@extends('common.layout')

@section('page_content')
    <div class="ui container">
        <div class="ui grid">
            <div class="eleven wide computer column">
                <div class="ui text container" style="max-width:100% !important">
                    <h2 class="ui header">{{ $article->title }}</h2>
                    <span class="ui sub header">作者：{{ $article->user->name }}  | <strong>{{ $article->view }}</strong> 次阅读 | {{ $article->comment->count() }} 个评论</span>
                    <hr>
                    {!! $article->content !!}
                </div>
                <h2 class="ui dividing header">相关评论</h2>
                <div class="ui comments">
                    @forelse($comments as $k => $v)
                        <div class="comment">
                            <a class="avatar">
                                <img src="{{ $v->user->cover }}">
                            </a>
                            <div class="content">
                                <a class="author">{{ $v->user->name }}</a>
                                @if($v->reply_user_id)
                                    回复 <a class="author">{{ $v->reply_user->name }}</a>
                                @endif
                                <div class="metadata">
                                    <div class="date">
                                        {{ $v->created_at }}
                                    </div>
                                </div>
                                <div class="text">
                                    {{ $v->content }}
                                </div>
                                <div class="actions">
                                    <a class="reply reply-button" data-author="{{ $v->user->id }}" data-name="{{ $v->user->name }}">回复</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        还没有评论 快来抢沙发~
                    @endforelse
                    <br>
                    {{ $comments->links('vendor.pagination.semantic-ui') }}
                    @include('common.formmessage')
                    <form class="ui reply form" id="form" method="POST" action="{{ url('comment/store') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <textarea name="content" id="content"></textarea>
                        </div>
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <input type="hidden" name="reply_user_id" id="reply_user_id" value="">
                        <button class="ui primary submit labeled icon button" type="su">
                            <i class="icon edit"></i> 添加评论
                        </button>
                    </form>
                </div>
            </div>
            <div class="five wide computer column">
                <h3 class="ui header">最热推荐</h3>
                <div class="ui divided items">
                    <div class="item">
                        <div class="ui tiny image">
                            <img src="/images/article_1.jpeg">
                        </div>
                        <div class="middle aligned content">
                            <a class="header">文章1</a>
                            <div class="meta">
                                <span class="author">来自<a>作者</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ui tiny image">
                            <img src="/images/article_2.jpeg">
                        </div>
                        <div class="middle aligned content">
                            <a class="header">文章2</a>
                            <div class="meta">
                                <span class="author">来自<a>作者</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ui tiny image">
                            <img src="/images/article_3.jpeg">
                        </div>
                        <div class="middle aligned content">
                            <a class="header">文章3</a>
                            <div class="meta">
                                <span class="author">来自<a>作者</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ui tiny image">
                            <img src="/images/article_4.jpeg">
                        </div>
                        <div class="middle aligned content">
                            <a class="header">文章4</a>
                            <div class="meta">
                                <span class="author">来自<a>作者</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ui tiny image">
                            <img src="/images/article_5.jpeg">
                        </div>
                        <div class="middle aligned content">
                            <a class="header">文章5</a>
                            <div class="meta">
                                <span class="author">来自<a>作者</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ui tiny image">
                            <img src="/images/article_6.jpeg">
                        </div>
                        <div class="middle aligned content">
                            <a class="header">文章6</a>
                            <div class="meta">
                                <span class="author">来自<a>作者</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@endsection
@section('extral_menu')
    <div class="item">
        <a class="ui green button" href="{{ url('article/create') }}">新建文摘</a>
    </div>
@endsection

@section('page_style')
    <style>
        .ui.comments .comment .avatar img, .ui.comments .comment img.avatar {
            height: inherit;
        }
    </style>
@endsection
@section('page_script')
    <script>
        $('.reply-button').on('click', function () {
            $('#reply_user_id').val($(this).data('author'));
            $('#content').focus().attr('placeholder','@'+$(this).data('name'));
        })

    </script>
@endsection