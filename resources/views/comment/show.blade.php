@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>评论详细</h5>
                </div>
                <div class="ibox-content">
                    <div class="list-group-item">
                        <div class="media-left">
                            内容:
                        </div>
                        <div class="media-right">
                            {{$comments->body}}
                        </div>
                    </div>
                    
                    <div class="item list-group-item">
                        <div class="media-left">
                            修改时间:
                        </div>
                        <div class="media-right">
                            {{$comments->updated_at}}
                        </div>
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            添加时间:
                        </div>
                        <div class="media-right">
                            {{$comments->created_at}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
