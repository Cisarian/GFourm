@extends ('base')

@section ('content')

<form action={{{ isset($category) ? route('category_update', [$game->slug , $category->slug]) :
                  route('category_store', $slug) }}} method='POST'>

@csrf
@isset($category)
    @method ('put')
@endisset

<label for='title'></label>Title</br>
<input name='title'
id='title'
value= @if (isset($category)) "{{$category->title}}" @endif>
</br>
@if($errors)
{{$errors->first('title')}}
@endif

@if(isset($validation))
<p>Category with the same name has already been created: {{$title}}<p>
@endif

</br><input type='submit' value='submit'>

</form>

@stop