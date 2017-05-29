@extends('index/base')
@section('content')
    <section id="content" class="container">
        <div class="row">
            <div class="col-md-12">
                @if($article->isEmpty())
                    <div class="ibox">
                        <div class="ibox-content text-center">
                            <h3>aha!!没有啦</h3>
                        </div>
                    </div>
                @else
                    @foreach($article as $vo)
                        <div class="ibox">
                            <div class="ibox-content p-md">
                                <a href="{{url('/article',$vo->id.'.html')}}" class="btn-link">
                                    <h2>
                                        {{$vo->title}}
                                    </h2>
                                </a>
                                <div class="small m-b-xs">
                                    <strong>{{$vo->category->name}}</strong>
                                    <span class="text-muted"><i class="fa fa-clock-o"></i>{{$vo->updated_at}}</span>
                                </div>
                                <p>
                                    {{$vo->description}}
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>标签:</h5>
                                        @foreach($vo->tags as $v)
                                            <button class="btn btn-primary btn-md" type="button">{{$v->name}}</button>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <div class="small text-right">
                                            <h5>统计:</h5>
                                            <div><i class="fa fa-comments-o"> </i>{{count($vo->comments)}}评论</div>
                                            <i class="fa fa-eye"> </i> {{$vo->count}} 阅读
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        /**
         * 处理导航高亮
         */
        $(function () {
            var cateid = '#nav-'+{!! $category_id !!}
           console.log(cateid);
            $(cateid).addClass('active').siblings().removeClass('active');
        })
    </script>
@endsection