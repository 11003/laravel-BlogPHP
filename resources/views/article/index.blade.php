@extends('common.layout')
@section('page_content')
    <div class="ui container">
        <div class="ui segments">
            <div class="ui segment">
                <div class="ui items">
                    @foreach($articles as $article)
                    <div class="item">
                        <div class="ui small image">
                            @if($article->cover == '')
                                <img src="/images/image.png">
                                @else
                                <img src="{{ $article->cover }}">
                            @endif
                        </div>
                        <div class="middle aligned content">
                            <div class="header">
                                {{ $article->title }}
                            </div>
                            <div class="description">
                               {{ $article->desc }}
                            </div>
                            <div class="extra">
                                @forelse($article->tag as $tags)
                                    <div class="ui label">
                                        <i class="globe icon"></i> {{ $tags->tag_name }}
                                    </div>
                                    @empty
                                    <div class="ui label">
                                        <i class="globe icon"></i> 无
                                    </div>
                                    @endforelse
                                <a class="ui right floated button" href="{{ url('article/show', ['aid'=> $article->id]) }}">
                                    阅读全文
                                </a>
                                @can('update',$article)
                                <a class="ui right floated blue button" href="{{ url('article/edit', ['aid'=> $article->id]) }}">
                                    修改
                                </a>
                                @endcan
                                @can('delete',$article)
                                <a class="ui right floated red button" href="{{ url('article/del', ['aid'=> $article->id]) }}" >
                                    删除
                                </a>
                                @endcan
                                <style>
                                    .ui.modal{
                                        top: 15%;
                                    }
                                </style>
                                @can('delete',$article)
                                <div class="ui modal">
                                    <h2 class="header">
                                        删除文摘
                                    </h2>
                                    <div class="content">
                                        你确定要删除文章吗

                                    </div>
                                    <div class="actions">
                                        <button class="ui negative button">否</button>
                                        <a class="ui positive button yes" data-href="">是</a>
                                    </div>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>

        <div class="ui center aligned container" style="margin:4em">
            {{ $articles->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
@endsection
@section('page_script')
    <script>
        $('a.delete').on('click',function(){
            $(this).siblings('.ui.modal').modal('show');
        });
        $('a.yes').on('click',function(){
            var href = $(this).data('href');
            $.ajax({
                url:href,
                type:'GET',
                dataType:'json',
                success:function(res){
                   console.log(res);
                }
            });
        });
    </script>
@endsection