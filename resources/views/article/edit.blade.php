@extends('layouts.app')
@section('content')
    {{--@include('vendor.ueditor.assets')--}}
    {!! editor_css() !!}
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>修改文章</h5>
                </div>
                <div class="ibox-content">
                    <form role="form"
                          method="POST"
                          action="{{url('dashboard/article',$article->id)}}"
                          class="form-horizontal form">
                        {{ csrf_field() }}
                        {{method_field('put')}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">标题:</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" value="{{$article->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">关键词:</label>
                            <div class="col-sm-9">
                                <input type="text" name="keywords" class="form-control" value="{{$article->keywords}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">描述:</label>
                            <div class="col-sm-9"><textarea name="description"
                                                            class="form-control">{{$article->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">分类:</label>
                            <div class="col-sm-9">
                                <select name="category_id" id="category" class="form-control">
                                    <option></option>
                                    @foreach($cateList as $key=> $vo)
                                        <option value="{{$key}}"
                                                @if($key ==$article->category->id) selected @endif>{{$vo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="showpic" class="col-sm-9 col-md-offset-2">
                                @if($article->pic)
                                    <img src="{{$article->pic}}" alt="" width="100%">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">略缩图:</label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new input-group">
                                    <div class="form-control" id="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists" style="display: none"></i>
                                        <span class="fileinput-filename">{{$article->pic}}</span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new" id="choicefile">选择文件</span>
                                        <input type="file" name="file" id="file" style="display: none;">
                                        <input type="text" name="pic" id="pic" value="" style="display: none">
                                    </span>
                                </div>
                            </div>
                        </div>
                        @php
                            $tags =[];
                            $data = $article->tags->toArray();
                            foreach ($data as $vo){
                                $tags[] = $vo['id'];
                            }
                        
                        @endphp
                        <div class="form-group">
                            <label class="col-sm-2 control-label">标签:</label>
                            <div class="col-sm-9">
                                <select class="tags form-control" name="tags[]" multiple="multiple">
                                    @foreach($tagsList as $key=> $vo)
                                        <option value="{{$key}}"
                                                @if(in_array($key,$tags))
                                                selected
                                                @endif
                                        >{{$vo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否发布:</label>
                            <div class="col-sm-9">
                                <div class="i-checks">
                                    <label class="checkbox-inline">
                                        <input type="radio"
                                               value="T"
                                               name="status"
                                               @if($article->status ==='T') checked="" @endif>
                                        <i></i>发布
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio"
                                               value="F"
                                               name="status"
                                               @if($article->status ==='F') checked="" @endif>
                                        <i></i>审核
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">内容:</label>
                            <div class="col-sm-9">
                                <div id="mdeditor" style="width: 100%;">
                                    <textarea class="form-control"
                                              name="content"
                                              style="display: none">{!! $article->content !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-2 ">
                                <button class="btn btn-success btn-block " type="submit">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    {!! editor_js() !!}
    {!! editor_config('mdeditor') !!}
    <script>
        $(function () {
            //上传略缩图
            $("#choicefile").click(function () {
                $("#file").click();
            });
            $("#fileinput").click(function () {
                $("#file").click();
            });
            var options = {
                url: '{{url('dashboard/uploadpic')}}',
                beforeSubmit: showRequest,
                success: showResponse,
                dataType: 'json'
            };

            $('#file').on('change', function () {
                console.log('article')
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

                    $("#showpic").empty().append('<img src="' + response.url + '" style="max-width: 100%;">')
                    $("#showpic").show();
                    $(".fileinput-filename").empty().append(response.url);
                    $("#pic").val(response.url);
                    $(".fileinput-exists").show();
                }
            }

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