@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑用户</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{url('dashboard/user',[$user->id])}}" method="POST" role="form" class="form-horizontal form">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" placeholder="如:http://xxx.com" value="{{$user->email}}">
                            </div>
                        </div>
                        <avatar avatars="{{$user->avatar}}"></avatar>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否启用:</label>
                            <div class="col-sm-9">
                                <div class="i-checks">
                                    <label class="checkbox-inline">
                                        <input type="radio" value="T" name="status" @if($user->status =='T') checked=""  @endif>
                                        <i></i>是
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="F" name="status" @if($user->status =='F') checked="" @endif>
                                        <i></i>否
                                    </label>
                                </div>
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
@section('js')
    <script>
        
        $(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            $(".tags").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
            $("#category").select2({
                placeholder: "选择分类",
                allowClear: true
            })
        });
    </script>
@endsection