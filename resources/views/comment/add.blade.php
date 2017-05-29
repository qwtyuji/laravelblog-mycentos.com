@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加标签</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{url('dashboard/tags')}}" method="POST" role="form" class="form-horizontal form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否启用:</label>
                            <div class="col-sm-9">
                                <div class="i-checks">
                                    <label class="checkbox-inline">
                                        <input type="radio" value="T" name="status" checked="">
                                        <i></i>是
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="F" name="status">
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
        });
    </script>
@endsection