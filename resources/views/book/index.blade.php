@extends('common.layout')

@section('page_content')
    <div class="pusher">
        <div class="ui container">
            <div class="ui segments">
                <div class="ui segment">
                    <div class="ui four link cards">
                        @foreach($books as $book)
                            <div class="card">
                                <div class="image">
                                    <img src="{{ $book->cover }}">
                                </div>
                                <div class="content">
                                    <div class="header">
                                        <a href="{{ url('book/show', $book->id) }}"> {{ $book->title }}</a>
                                    </div>
                                    <div class="meta">
                                       {{ $book->author }}
                                    </div>
                                    <div class="description">
                                        {{ str_limit($book->desc,30,'....') }}
                                    </div>
                                </div>
                                <div class="extra content">
                                    <span class="right floated">{{ $book->created_at->formatLocalized('%d, %B %Y') }} </span>
                                    <span><i class="user icon"></i> {{ $book->article_count }} 篇文摘 </span>
                                </div>
                                <div class="extra content">
                                    <a href="{{ url('article/create', ['book_id' => $book->id]) }}" class="ui basic fluid green button">写文摘</a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="ui center aligned container" style="margin:4em">
                {{ $books->links('vendor.pagination.semantic-ui') }}
            </div>
        </div>
    </div>
@endsection
