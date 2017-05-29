@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>后台用户</h5>
                </div>
                <div class="ibox-content">
                    <div class="col-md-2 p-h-xs">
                        <a href="{{url('dashboard/admin/create')}}"><button class="btn btn-info btn-block">添加</button></a>
                    </div>
                    <div class="col-md-6 p-h-xs col-md-offset-4">
                        <input type="text" class="form-control input-md  m-b-md" id="search" placeholder="Search">
                    </div>
                    <table class="footable table table-stripped toggle-arrow-tiny table-bordered"
                           data-page-size="{{config('page.pagenum')}}"
                           data-filter=#search>
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>邮箱</th>
                            <th>图像</th>
                            <th>状态</th>
                            <th data-hide="phone,tablet">添加时间</th>
                            <th data-hide="phone,tablet">修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $vo)
                            <tr>
                                <td>{{$vo->name}}</td>
                                <td>
                                    {{$vo->email}}
                                </td>
                                <td><img src="{{$vo->avatar}}" alt="" class="img-sm"></td>
    
                                <td>
                                    {{config('hupo.status')[$vo->status]}}
                                </td>
                                <td>{{$vo->updated_at}}</td>
                                <td>{{$vo->created_at}}</td>
                                <td>
                                    <a href="{{url('dashboard/admin',$vo->id)}}" class="btn btn-xs btn-primary">查看</a>
                                    <a href="{{url('dashboard/admin',[$vo->id,'edit'])}}" class="btn btn-xs btn-success">修改</a>
                                    <form action="{{url('dashboard/admin',$vo->id)}}" method="post" class="form-horizontal" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"  class="btn btn-xs btn-warning">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    
    <script>
        $(document).ready(function () {
            $('.footable').footable();
        });
    
    </script>
@endsection
