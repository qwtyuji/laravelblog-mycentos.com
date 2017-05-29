@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>用户详细</h5>
                </div>
                <div class="ibox-content">
                    <div class="item list-group-item">
                        <div class="media">
                            <div class="media-left">
                            </div>
                            <div class="media-right">
                                <img src="{{$admin->avatar}}" class="img-lg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="media-left">
                            用户名:
                        </div>
                        <div class="media-right">
                            {{$admin->name}}
                        </div>
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            Email:
                        </div>
                        <div class="media-right">
                            {{$admin->email}}
                        </div>
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            修改时间:
                        </div>
                        <div class="media-right">
                            {{$admin->updated_at}}
                        </div>
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            添加时间:
                        </div>
                        <div class="media-right">
                            {{$admin->created_at}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
