@extends ('base')

@section ('content')

@auth
<a href={{{ route('post_create', [$game->slug, $category->slug]) }}}>Create</a> 
@endauth


@forelse ($posts as $post)

<p><a href={{{ route('post_detail', [$game->slug,
                                    $category->slug,
                                    $post->slug]) }}}>{{$post->title}}</a>
@auth                                    
@if (Auth::user()->id == $post->user_id)                                    
<a href={{{ route('post_edit', [$game->slug,
                                $category->slug,
                                $post->slug]) }}}>Edit</a>
@else

@endif
@endauth
</p>

@empty
<h1> No Posts Currently </h1>
@endforelse

@stop