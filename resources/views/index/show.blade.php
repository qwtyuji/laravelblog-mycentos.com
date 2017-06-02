@extends('index/base')
@section('title')
    <title>{{$article->title}}-Mycentos Blog</title>
    <meta name="description" content="{{$article->keywords}}" />
    <meta name="keywords" content="{{$article->description}}" />
@endsection
@section('content')
    <link rel="stylesheet" href="/vendor/editor.md/css/editormd.preview.css" />
    <article class="article">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <ul class="breadcrumb" style="font-size: 18px;">
                                <li>
                                    <a href="/">首页</a>
                                </li>
                                @foreach($cateTree as $vo)
                                    @if($loop->last)
                                        <li class="active">
                                            {{$vo['name']}}
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{url('/categoryies',$vo['id'])}}">{{$vo['name']}}</a>
                                        </li>
                                    @endif
                                
                                @endforeach
                            </ul>
                            <div class="text-center">
                                <h2>
                                    {{$article->title}}
                                </h2>
                                <span class="text-muted"><i class="fa fa-clock-o"></i>{{$article->updated_at}}</span>
                            
                            </div>
                            <div class="article-content editormd-preview-theme-dark" id="contentView">
                                <textarea style="display:none;"
                                          name="editormd-markdown-doc">{!!$article->content!!}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>标签:</h4>
                                @foreach($article->tags as $v)
                                    <button class="btn btn-primary btn-md" type="button">{{$v->name}}</button>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <div class="text-right">
                                    <h4>统计:</h4>
                                    <div><i class="fa fa-comments-o"> </i> {{$article->comments->count()}} 条评论</div>
                                    <script src="{{url('article/count',$article->id)}}"></script>
                                    <i class="fa fa-eye"> </i> {{$article->count}} 访问
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>发表评论:</h2>
                                <div class="social-feed-box p-lg">
                                    @if(auth()->check())
                                    <div class="commentable">
                                        <div class="comment-avatar">
                                            <a href="" class="pull-left">
                                                <img alt="image" src="{{auth()->user()->avatar}}" class="img-circle">
                                            </a>
                                        </div>
                                        <div class="comment-box">
                                            <form class="ui reply-form"  method="POST" id="comment-form">
                                                <div class="field">
                                                    <textarea name="body" id="comment-body" class="form-control" placeholder="支持markdown语法"></textarea>
                                                </div>
                                                <button type="button" class="btn btn-success reply-button" id="comment-button">发表回复</button>
                                                <span class="errors comment-errors" style="display: none">请认真发评论哦,至少 <strong>6</strong> 个字符</span>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                        <div class="p-lg">
                                            <a href="{{route('login')}}" class="btn btn-block btn-success">请先登录</a>
                                        </div>
                                    @endif
                                    <div class="comment-in">
                                    @foreach($comments as $vo)
                                        <div class="comment">
                                            <div class="comment-avatar">
                                                <a href="" class="pull-left">
                                                    <img alt="image" src="{{$vo['user']['avatar']}}" class="img-circle">
                                                </a>
                                            </div>
                                            <div class="comment-body">
                                                <h3>{{$vo['user']['name']}}</h3>
                                                <p>{{$vo['created_at']}}</p>
                                                <div class="comment-content">
                                                    {{$vo['body']}}
                                                </div>
                                                <div class="comment-action">
                                                    <button type="button" class="btn-success btn btn-xs reply" data-id="{{$vo['id']}}">
                                                        回复
                                                    </button>
                                                    <button class="btn btn-info btn-xs" style="margin-left: 10px;">
                                                        赞
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="comment-box">
                                            </div>
                                           @if(isset($vo['children']))
                                                @each('comments', $vo['children'], 'vo')
                                               @else
                                           @endif
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        </div>
    </article>

@endsection
@section('js')
    {!! editor_js() !!}
    <script>
        //显示内容
        $(document).ready(function () {
            var contentView;
            contentView = editormd.markdownToHTML("contentView", {
                htmlDecode: "style,script,iframe",  // you can filter tags decode
                emoji: true,
                taskList: true,
                tex: true,  // 默认不解析
                flowChart: true,  // 默认不解析
                sequenceDiagram: true,  // 默认不解析
            });
        })
        /**
         * 处理导航高亮
         */
        $(function () {
            var cateid = '#nav-' + {!! $article->category_id !!}
            $(cateid).addClass('active').siblings().removeClass('active');
        })

        /**
         * 评论
         * @type {string}
         */
        var t = '<form class="ui reply-form" method="POST" id="reply-form"><div class="field"><textarea name="body" required class="form-control" placeholder="支持markdown语法"></textarea></div><div class="btn btn-default reply-cancel-button" id="reply-cancel-button">取消回复</div><div class="reply-button btn btn-success" id="reply-button">发表回复</div><span class="errors comment-errors" style="display: none">请认真发评论哦,至少 <strong>6</strong> 个字符</span></form>';
        $('.comment .reply').on('click', function () {
            var r = $(this)
            if ($(this).hasClass("active")) {
                $(this).parent().parent().parent().find(".comment-box").find("form").remove()
                $(this).removeClass("active")
            } else {
                $(this).addClass("active")
                $(this).parent().parent().parent().find(".comment-box").first().append(t)
            }
            $(".reply-cancel-button").on('click', function () {
                return $(this).parent().remove(), r.removeClass("active"), !1
            })
            $('.reply-button').on('click', function () {
                var a = $(this);
                $('#reply-form').ajaxSubmit({
                    type: 'post',
                    url: '{!! url('comments') !!}',
                    data: {
                        'body': $('#reply-form').find('textarea').val(),
                        'parent_id':r.attr('data-id'),
                        'user_id': Laravel.user_id,
                        'article_id': {!! $article->id !!},
                        '_token':Laravel.csrfToken
                    },
                    success: function (rt) {
                        data = rt.data;
                        var s ='<div class="comment"> <div class="comment-avatar"> <a href="" class="pull-left"> <img alt="image" src="'+Laravel.user_avatar+'" class="img-circle"> </a> </div> <div class="comment-body"> <h3>'+Laravel.user_name+'</h3> <p>'+data.created_at+'</p> <div class="comment-content">'+data.body+'</div> <div class="comment-action"> <button type="button" class="btn-success btn btn-xs reply" id="reply" data-id="'+data.id+'">回复 </button> <button class="btn btn-info btn-xs" style="margin-left: 10px;">赞 </button> </div> </div> <div class="comment-box"> </div></div>';
                        $(s).insertAfter(a.parent().parent())
                        a.parent().parent().find('form').remove()
                        
                    },
                    error:function () {
                        a.parent().parent().find('span').show()
                    }
                })
            })
        })
        
        /**
         *提交评论
         */
        $('#comment-button').on('click', function () {
            var d = $(this)
            var body = $('#comment-body').val();
            if(body.length < 6){
                $(this).parent().find('span').show()
                return false;
            }
            $('#comment-form').ajaxSubmit({
                type: 'post',
                url: '{!! url('comments') !!}',
                dataType:"json",
                data: {
                'body': $('#comment-body').val(),
                'user_id': Laravel.user_id,
                'article_id': {!! $article->id !!},
                '_token':Laravel.csrfToken
                },
                success: function (rt) {
                        data = rt.data;
                        var s ='<div class="comment"> <div class="comment-avatar"> <a href="" class="pull-left"> <img alt="image" src="'+Laravel.user_avatar+'" class="img-circle"> </a> </div> <div class="comment-body"> <h3>'+Laravel.user_name+'</h3> <p>'+data.created_at+'</p> <div class="comment-content">'+data.body+'</div> <div class="comment-action"> <button type="button" class="btn-success btn btn-xs reply" data-id="'+data.id+'">回复 </button> <button class="btn btn-info btn-xs" style="margin-left: 10px;">赞 </button> </div> </div> <div class="comment-box"> </div></div>';
                        $('.comment-in').prepend(s);
                        $('#comment-body').val('');
                },
                error:function(){
                    d.parent().parent().find('span').show();
                }
            });
            return false;
        })
        $('#comment-body').on('focus',function () {
            $(this).parent().parent().find('span').hide();
        })
    </script>
@endsection