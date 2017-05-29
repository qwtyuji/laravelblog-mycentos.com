@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-waring pull-right">总共</span>
                        <h5>访问</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$totalVist}}</h1>
                        <div class="font-bold text-success">
                            <small>次访问</small>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">总共</span>
                        <h5>用户</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="no-margins">{{$totalUser}}</h1>
                                <div class="font-bold text-navy">
                                    <small>个用户</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">总共</span>
                        <h5>评论</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$totalComment}}</h1>
                        <div class=" font-bold text-info">
                            <small>条评论</small>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>访问次数最多的文章</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="#">Config option 1</a>
                                </li>
                                <li>
                                    <a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    
                                    <th>#</th>
                                    <th>标题</th>
                                    <th>分类</th>
                                    <th>标签</th>
                                    <th>访问次数</th>
                                    <th>评论条数</th>
                                    <th>修改时间</th>
                                    <th>添加时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($article as $vo)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$vo->title}}</td>
                                    <td>{{$vo->category->name}}</td>
                                    <td>
                                        @foreach($vo->tags as $vo)
                                            <a href="" class="btn btn-xs btn-info"> {{$vo->name}}</a>
                                            @endforeach
                                    </td>
                                    <td>{{$vo->count}}</td>
                                    <td>
                                        <span class="pie">{{count($vo->comment)}}</span>
                                    </td>
                                    <td>{{$vo->updated_at}}</td>
                                    <td>{{$vo->created_at}}</td>
                                    
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                    </div>
                </div>
            </div>
        
        </div>
    </div>
@endsection
