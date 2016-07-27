@extends('admin')

@section('content')
<div class="row">
    <h3>Sign in</h3>
    <div class="small-6 column">
        <form class="form-vertical" role="form" method="post" action="{{route('auth.signin') }}">
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">Email</label>
                <input type="text" name="email" class="form-control" id="email"
                       value="{{ Request::old('email') ?: '' }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        {{$errors->first('email')}}
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                       value=" {{ Request::old('password') ?: '' }}">
                @if ($errors->has('password'))
                    <span class="help-block">
                        {{$errors->first('password')}}
                    </span>
                @endif
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <div class="form-gorup">
                <button type="submit" class="btn btn-default">Sign in</button>
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
        </form>
    </div>
</div>
@endsection
