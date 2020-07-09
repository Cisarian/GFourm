@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <p>Please use below to change name/password<p>
                    <form action={{{ route('change_password', Auth::user()->id) }}} method='post'>
                    @csrf
                    
                    <label for="name">user</label>
                    <input type="text" name='name' id='name' value={{ Auth::user()->name }}>
                    <p>
                    @if($errors)
                    {{ $errors->first('user') }}
                    @endif 
                    </p>
                    <p>                                       
                    <label for="password">Password</label>
                    <input type="password" name='password' id='password'>
                    </p>
                    @if($errors)
                    <p>{{ $errors->first('password') }}<p>
                    @endif
                   

                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name='password_confirmation' id='password_confirm'>
                    @if($errors)
                    {{ $errors->first('password_confirm') }}
                    @endif
                    <p>
                    <input type="submit" value='submit'>
                    </p>                    

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
