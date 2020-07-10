@extends ('base')

@section ('content')

<form 
action= {{{ isset($games) ? route('games_update', $games->slug) : route('games_store') }}} method='POST'>

@csrf
@isset($games)
    @method ('put')
@endisset

<label for='title'> Title </label></br>

<input name='title' id='title' value = @if (isset($games))"{{$games->title}}" @endif> </br>
{{$errors->first('title')}}
@if (isset($validation))
<p> Game already exist: {{$title}} </p>
@endif

</br><input type='submit' value='submit'>    

</form>

@stop