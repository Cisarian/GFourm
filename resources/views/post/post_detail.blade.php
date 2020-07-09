@extends ('base')

@section ('content')


<p><h1>{{$post->title}}</h1></p>


<p>{{$user->name}}: {{$post->body}}</p>

@foreach($comments as $comment)


<p>{{$comment->name}}:  {{ $comment -> user_comment }}
@auth
@if (Auth::user()->id == $comment->user_id)
<a href= {{{ route('comment_edit', [$post, $comment]) }}} >Edit</a>
<form action={{{ route('comment_delete', $comment->id) }}} method='post'>

@csrf
@method('delete')
<input type="submit" value='delete'>

</form>
@endif
@endauth
</p>

@endforeach
@auth
<form action={{{ route('post_comment', $post) }}} method='post'>

@csrf


<label for="user_comment">Body</label>
<textarea name="user_comment" id="user_comment" cols="30" rows="10">
</textarea>
@if($errors)
{{$errors->first('body')}}
@endif


<input type="submit" value='submit'>

</form>
@else

Please <a href="{{ route('login') }}">Login</a> in to make a comment 
@endauth


@stop
