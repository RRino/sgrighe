@extends('layouts.app')

@section('content')
<div class="row">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>titolo</th>
            </tr>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td><a href="/posts/show/{{ $post->id }}">{{ $post->id }}</a></td>
                    <td>{{ $post->title }}</td>
                </tr>
            @endforeach
        <tbody>
    </table>
</div>
@endsection