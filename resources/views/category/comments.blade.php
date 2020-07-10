@extends ('base')

@section ('content')

<h1> {{$category->name}} </h1>

@foreach ($comments as $comment)
<p>
user: {{$comment->name}}        
message: {{ $comment->user_comment}}
<p>

@endforeach

@stop