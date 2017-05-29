@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑友链</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{url('dashboard/link',[$links->id])}}" method="POST" role="form" class="form-horizontal form">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="{{$links->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Url:</label>
                            <div class="col-sm-9">
                                <input type="text" name="url" class="form-control" placeholder="如:http://xxx.com" value="{{$links->url}}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div id="showpic" class="col-sm-9 col-md-offset-2">
                                <img src="{{$links->pic}}" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">略缩图:</label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new input-group">
                                    <div class="form-control" id="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists" style="display: none"></i>
                                        <span class="fileinput-filename">{{$links->pic}}</span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new" id="choicefile">选择文件</span>
                                        <input type="file" name="file" id="file" style="display: none;">
                                        <input type="text" name="pic" id="pic" value="{{$links->pic}}" style="display: none">

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否启用:</label>
                            <div class="col-sm-9">
                                <div class="i-checks">
                                    <label class="checkbox-inline">
                                        <input type="radio" value="T" name="status" @if($links->status =='T') checked=""> @endif
                                        <i></i>是
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="F" name="status" @if($links->status =='F') checked="" @endif>
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
        //上传略缩图
        $("#choicefile").click(function () {
            $("#file").click();
        });
        $("#fileinput").click(function () {
            $("#file").click();
        });
        $("#picdel").click(function () {
            console.log('del')
            $("#showpic").empty().hide();
            $(".fileinput-exists").hide();
            $("#choicefile").html('选择文件')
            $(".fileinput-filename").empty();
        })

        var options = {
            url: '{{url('dashboard/uploadpic')}}',
            beforeSubmit: showRequest,
            success: showResponse,
            dataType: 'json'
        };

        $('#file').on('change', function () {
            $(".form").ajaxSubmit(options);

        });
        function showRequest() {
            $("#output").css('display', 'none').empty();
            return true;
        }

        function showResponse(response) {
            if (response.success == false) {
                var responseErrors = response.errors;
                $.each(responseErrors, function (index, value) {
                    if (value.length != 0) {
                        $("#validation-errors").append('<div class="alert alert-error"><strong>' + value + '</strong><div>');
                    }
                });
                $("#validation-errors").show();
            } else {
                $('#choicefile').html('上传成功');
                $("#showpic").append('<img src="' + response.url + '" style="max-width: 100%;">')
                $("#showpic").show();
                $(".fileinput-filename").append(response.url);
                $("#pic").val(response.url);
                $(".fileinput-exists").show();
            }
        }
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