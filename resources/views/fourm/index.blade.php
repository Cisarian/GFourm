@extends ('base')

@section ('content')

@auth
<a href={{{ route('games_create') }}}>Create</a>
@endauth

@foreach ($games as $game)

<p><a href= {{{ route('category_list', $game->slug) }}}>{{$game->title}}</a>
@auth
<a href={{{ route('game_edit', $game->slug) }}}>Edit</a>
<form action= {{{ route('game_delete', $game->slug) }}} method='post'>

@csrf

<!-- Possible Delete method for admin in the future
@method('delete')
<input type="submit" value='delete'>

</form>
-->
</p>
@else
<p>Please <a href="{{ route('login') }}">Login</a> to make a game</p>
@endauth
@endforeach

@stop