@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加用户</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{url('dashboard/user')}}" method="POST" role="form" class="form-horizontal form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <avatar></avatar>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">用户名:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" value="{{old('email')}}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}" >
                            <label class="col-sm-2 control-label">密码:</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-2 ">
                                <button class="btn btn-info btn-block " type="submit">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
