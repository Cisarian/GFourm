@extends ('base')

@section ('content')



<form action={{{ isset($post) ? route('post_update',[$game->slug, $category->slug, $post->slug]) :
route('post_store', [$game->slug, $category->slug]) }}}
method='POST'>
@csrf

@isset($post)
    @method ('put')
@endisset

<label for="title">Title</label>
<input type="text" name='title' id='title'
value= @if (isset($post)) {{$post->title}} @endif>
@if($errors)
{{$errors->first('title')}}
@endif

<label for="body">Text Body</label>
<p>
<textarea name="body" id="body" cols="30" rows="10">
@if (isset($post)){{$post->body}}@endif


</textarea>
<p>
@if($errors)
<p>{{$errors->first('body')}}<p>
@endif

<input type='submit' value='submit'> 


</form>

@stop