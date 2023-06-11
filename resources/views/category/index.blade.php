@extends('layout')

@section('content')
    <h1 class="page-header">
        مقالات سایت
    </h1>

    <!-- First Blog Post -->
    @foreach($articles as $article)
        <div>
            <h2>
                <a href="{{route('article.show', ['article' => $article->id])}}">
                    {{ $article->title }}
                </a>
            </h2>
            <p class="lead">
                ارسال شده توسط <a href="index.php">
                    {{ $article->user->name ?? 'None'}}
                </a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span>ارسال شده در تاریخ {{ jdate($article->created_at)->format('%B %d, %Y') }}</p>
            <hr>
            @if(!empty($article->image))
                <img class="img-responsive" src="/images/{{$article->image}}" alt="">
            @endif

            @if(empty($article->image))
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
            @endif
            <hr>
            <p>
                {{ $article->body }}
            </p>
            <a class="btn btn-primary" href="{{route('article.show', ['article' => $article->id])}}">ادامه مطلب <span
                    class="glyphicon glyphicon-chevron-left"></span></a>
        </div>

        @if(! $loop->last)
            <hr>
        @endif

    @endforeach

    <!-- Pager -->
    <div style="text-align:center;">
        {!! $articles->render() !!}
    </div>

@endsection
