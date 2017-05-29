@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">修改用户信息</div>
                    
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('dashboard/updateInfoStore') }}">
                            {{ csrf_field() }}
                            <div class="row">
                            
                            </div>
                            <div class="form-group">
                                <avatar avatars="{{$info->avatar}}"></avatar>

                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                
                                <label for="password" class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-8">
                                    <input id="password" type="text" class="form-control" name="name" required value="{{$info->name}}">
                                    
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="password" class="col-sm-2 control-label">Email</label>
        
                                <div class="col-sm-8">
                                    <input id="password" type="text" class="form-control" name="email" required value="{{$info->email}}">
            
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        保存
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection