@extends ('base')

@auth
<a href={{{ route('create_category', $slug) }}}>Create</a>
@endauth


@section ('content')

@forelse($categories as $category)
<p><a href={{{ route('post_list', [$game->slug, $category->slug]) }}}>{{$category->title}}</a>
<a href={{{ route('category_edit', [$game->slug, $category->slug]) }}}>Edit</a>
</p>
@empty
<h1>No Categories Here</h1>
@endforelse

@guest
To create a category please <a href="{{ route('login') }}">Login</a>
@endguest

@stop 