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

    <form action="{{ route('article.store') }}" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">عنوان مقاله</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="عنوان مقاله">
        </div>
        <div class="mb-3">
            <label style="margin-top: 16px;" for="body" class="form-label">متن مقاله</label>
            <textarea class="form-control" name="body" id="body" rows="7"  placeholder="متن مقاله"></textarea>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary" style="margin-top: 16px;">ثبت مقاله</button>
    </form>


@endsection
