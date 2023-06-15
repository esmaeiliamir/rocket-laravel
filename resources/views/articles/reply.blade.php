@extends('layout')

@section('content')

    @if(count($errors))
        <div class="alert alert-warning" role="alert">
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('comment.reply', $comment->id) }}" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">نام</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="نام">
        </div>
        <div class="mb-3">
            <label style="margin-top: 16px;" for="body" class="form-label">متن پاسخ</label>
            <textarea class="form-control" name="body" id="body" rows="7"  placeholder="متن پاسخ"></textarea>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary" style="margin-top: 16px;">ثبت پاسخ</button>
    </form>


@endsection
