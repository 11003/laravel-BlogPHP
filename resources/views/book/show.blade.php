@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <h2 class="ui header">
            <img src="{{ $book->cover }}" class="ui circular image">
            《{{ $book->title }}》
            <div class="sub header">{{ $book->desc }}</div>
        </h2>
        <div class="ui piled segment">
            {!! $book->content !!}
        </div>
        <h2 class="ui dividing header">相关文摘</h2>
        <div class="ui stacked segments">
            @forelse($book->article as $article_value)
                <div class="ui segment">
                    <a href="{{ url('article/show', $article_value->id) }}">{{ $article_value->title }}</a>
                </div>
            @empty
                <div class="ui segment">
                    这本图书下面还没有任何文摘 快去 <a href="{{ url('article/create', ['book_id' => $book->id]) }}">写一篇</a> 吧
                </div>
            @endforelse
        </div>
    </div>

@endsection