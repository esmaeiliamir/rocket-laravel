@extends('layout')


@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $article->title }}</h1>

    <!-- Author -->
    <p class="lead">
        ارسال شده توسط <a href="index.php">
            {{$article->user->name}}
        </a>
    </p>

    <hr>

    <!-- Date/Time -->

    <p><span class="glyphicon glyphicon-time"></span> ارسال شده در
        تاریخ {{  jdate($article->created_at)->format('%B %d، %Y') }}</p>

    <p>
        امتیاز: {{ number_format($averageRating, 2) }}
    </p>


    @if(Auth::check())
        <div style="display: flex;">
            @if($liked)
                <form method="POST" action="{{ route('article.like', $article->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">Dislike</button>
                </form>
            @endif
            @if(!($liked))
                <form method="POST" action="{{ route('article.like', $article->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">Like</button>
                </form>
            @endif
        </div>
    @endif

    <hr>



    <!-- Preview Image -->
    @if(!empty($article->image))
        <img class="img-responsive" src="/images/{{$article->image}}" alt="">
    @endif

    @if(empty($article->image))
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
    @endif

    <hr>

    <!-- Post Content -->
    {!! $article->body !!}
    <hr>

    @if(Auth::check())
            <form method="post" role="form" action="{{ route('article.rate', ['article' => $article->id]) }}">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Rate this Post</span>
                    </div>
                    {{ csrf_field() }}
                    <input type="number" name="rating" class="form-control" aria-label="Small"
                           aria-describedby="inputGroup-sizing-sm">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 8px; margin-bottom: 8px">ثبت امتیاز
                </button>
            </form>
        @endif


    @if(Auth::check())

        <!-- Comments Form -->
        <div class="well">
            @if(count($errors))
                <div class="alert alert-warning" role="alert">
                    @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </div>
            @endif

            <h4>ارسال کامنت :</h4>
            <form role="form" action="{{ route('comment.store', ['article' => $article->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">نام</label>
                    <input type="text" name="name" placeholder="نام" class="form-control" rows="3"/>
                </div>
                <div class="form-group">
                    <label for="body">متن</label>
                    <textarea name="body" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">ارسال</button>
            </form>
        </div>
    @endif

    <hr>

    <!-- Posted Comments -->

    @foreach($comments as $comment)
        <!-- Comment -->
        <div class="media">
            <div class="media-body">
                <h4 class="media-heading">{{ $comment->name }}
                    <small>ارسال شده در تاریخ {{ jdate($comment->created_at)->format('%B %d, %Y') }} </small>
                </h4>
                {{ $comment->body }}
            </div>
        </div>
    @endforeach

@endsection
