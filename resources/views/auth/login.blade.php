@extends('index/base')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        
        <form class="form-horizontal m-t" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" placeholder="email" name="email"
                       value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" placeholder="Password" name="password"
                       required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                    登录
                </button>
            </div>
            <div class="form-group">
                <a href="{{url('user/password/reset')}}">忘记密码</a>
                <a href="{{url('auth/github')}}" class="fa fa-github pull-right">github登录</a>

            </div>
            <div class="form-group text-center">
                <a  class="btn">没有账号?</a>
                <a href="{{url('user/register')}}" class="btn btn-block btn-primary">马上注册</a>
            </div>
        </form>
        
    </div>
</div>
@endsection