@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加分类</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{url('dashboard/category')}}" method="POST" role="form" class="form-horizontal form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">上级分类:</label>
                            <div class="col-sm-9">
                                <select name="pid" id="category" class="form-control">
                                    <option></option>
                                    @foreach($cateList as $key=> $vo)
                                    <option value="{{$key}}">{{$vo}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="showpic" class="col-sm-9 col-md-offset-2"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">略缩图:</label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new input-group">
                                    <div class="form-control" id="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists" style="display: none"></i>
                                        <span class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new" id="choicefile">选择文件</span>
                                        <input type="file" name="file" id="file" style="display: none;">
                                        <input type="text" name="pic" id="pic" value="" style="display: none">
                                    </span>
                                    <a href="#"
                                       class="input-group-addon btn btn-default fileinput-exists"
                                       id="picdel"
                                       style="display: none">删除
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">关键词:</label>
                            <div class="col-sm-9">
                                <input type="text" name="keywords" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">描述:</label>
                            <div class="col-sm-9"><textarea name="description" class="form-control"></textarea></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否启用:</label>
                            <div class="col-sm-9">
                                <div class="i-checks">
                                    <label class="checkbox-inline">
                                        <input type="radio" value="1" name="status">
                                        <i></i>是
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio" checked="" value="0" name="status">
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
            console.log('0000')
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