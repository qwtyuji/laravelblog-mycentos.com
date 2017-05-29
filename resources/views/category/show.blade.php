@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>分类详细</h5>
                </div>
                <div class="ibox-content">
                    <div class="list-group-item">
                        <div class="media-left">
                            名称:
                        </div>
                        <div class="media-right">
                            {{$category->name}}
                        </div>
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            关键词:
                        </div>
                        <div class="media-right">
                            {{$category->keywords}}
                        </div>
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            描述:
                        </div>
                        <div class="media-right">
                            {{$category->description}}
                        </div>
                      
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            分类:
                        </div>
                        <div class="media-right">
                            {{$cateList[$category->pid]}}
                        </div>
                        
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            状态:
                        </div>
                        <div class="media-right">
                            {{config('hupo.status')[$category->status]}}
                        </div>
                        
                    </div>
                    <div class="item list-group-item">
                        <div class="media-left">
                            首页显示:
                        </div>
                        <div class="media-right">
                            {{config('hupo.show')[$category->show_home]}}
                        </div>
    
                    </div>
                    <div class="item list-group-item">
                        <div class="media">
                            <div class="media-left">
                                略缩图:
                            </div>
                            <div class="media-right">
                                <img src="{{$category->pic}}" class="img-lg" alt="">

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
