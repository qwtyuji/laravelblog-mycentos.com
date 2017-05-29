@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑标签</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{url('dashboard/comment',[$comments->id])}}" method="POST" role="form" class="form-horizontal form">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">内容:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="height: 200px;" name="body">{{$comments->body}}</textarea>
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
