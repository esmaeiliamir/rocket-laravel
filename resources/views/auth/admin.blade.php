@extends('layout')


<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Average Rating</th>
        <th scope="col">Rating Counts</th>
        <th scope="col">Likes Counts</th>
        <th scope="col">Comments Counts</th>
    </tr>
    </thead>
    <tbody>
    @foreach($articles as $article)
        <tr>
            <th scope="row">{{ $article->id }}</th>
            <td>{{ $article->title }}</td>
            <td>
                {{ number_format($article->rates_avg_rate, 2) }}
            </td>
            <td>
                {{ ($article->rates_count) }}
            </td>
            <td>
                {{ ($article->likes_count) }}
            </td>
            <td>
                {{ ($article->comments_count) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
