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

<form action="{{ route('category.store') }}" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">عنوان کتگوری</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="عنوان کتگوری">
    </div>


    {{ csrf_field() }}
    <button type="submit" class="btn btn-primary" style="margin-top: 16px;">ثبت کتگوری</button>
</form>


@endsection
