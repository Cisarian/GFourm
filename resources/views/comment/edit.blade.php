@extends ('base')

@section ('content')

<form action= {{{ route('comment_update', [$post, $comment]) }}}
method='post'
>
@csrf

@method('put')

<label for="user_comment">Body</label>
<textarea name="user_comment" id="user_comment" cols="30" rows="10">
{{ $comment->user_comment }}
</textarea>
<input type="submit" value='submit'>

@if ($errors)
{{$errors->first('user_comment')}}
@endif

</form>

@stop