@extends('common.layout')
@section('page_content')
    <!-- Page Contents -->
    <div class="pusher">
        <div class="ui inverted vertical masthead center aligned segment index_banner_img">
            <div class="ui text container">
                <h1 class="ui inverted header">
                    慕课书屋
                </h1>
                <h2>没有谁是一座孤岛 每本书都是一个世界</h2>
                <div class="ui huge primary button start-reading">
                    开始阅读 <i class="right arrow icon"></i>
                </div>
            </div>
        </div>
        <div class="ui vertical stripe segment">
            <div class="ui container">
                <h2 class="ui center aligned icon header">
                    <i class="circular student icon"></i> 热门文摘
                </h2>
                <div class="ui link four cards">
                    @foreach($hot_articles as $k => $v)
                    <div class="card">
                        <div class="image" onclick="window.open('{{ url('article/show', $v->id) }}')">
                            <img src="{{ $v->cover }}">
                        </div>
                        <div class="content">
                            <div class="header">
                                <a href="{{ url('article/show', $v->id) }}">{{ $v->title }}</a>
                            </div>
                            <div class="description">
                               {{ $v->desc }}
                            </div>
                        </div>
                        <div class="extra content">
                            <span class="right floated">498 次阅读</span>
                            <span><i class="user icon"></i>0 人评论 </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="ui vertical stripe segment">
            <div class="ui middle aligned stackable grid container">
                <h2 class="ui center aligned icon header">
                    <i class="circular book icon"></i> 热门图书
                </h2>
                <div class="ui grid">
                    @foreach($hot_books as $k => $v)
                    <div class="four wide column">
                        <div class="ui special cards">
                            <div class="card">
                                <div class="blurring dimmable image">
                                    <div class="ui inverted dimmer">
                                        <div class="content">
                                            <div class="center">
                                                <a href="#" class="ui primary button">
                                                    查看详情
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{ $v->cover }}">
                                </div>
                                <div class="content">
                                    <a class="header">{{ $v->title }}</a>
                                    <div class="meta">
                                        <span class="date"> {{ $v->desc }}</span>
                                    </div>
                                </div>
                                <div class="extra content">
                                    <a><i class="users icon"></i> {{ $v->article_count }} 篇文摘 </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="ui vertical stripe segment">
            <div class="ui middle aligned stackable grid container">
                <h2 class="ui header">
                    <i class="fire icon red"></i>
                    <div class="content">热门标签</div>
                </h2>
                <div class="ui tag labels">
                    <a class="ui label green">悬疑恐怖</a>
                    <a class="ui label teal">搞笑</a>
                    <a class="ui label blue">言情</a>
                    <a class="ui label violet">抒情</a>
                    <a class="ui label purple">叙事</a>
                    <a class="ui label pink">纪实</a>
                </div>
            </div>
        </div>
@endsection