<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/plugins/footable/footable.core.css" rel="stylesheet">
    <link href="/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    {{--上传图片样式--}}
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="/js/jquery-2.1.1.js"></script>

</head>
<body class="top-navigation">
<div id="app">

<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg" >
            <nav class="navbar navbar-static-top navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="{{ url('/') }}" class="navbar-brand">{{config('app.name')}}</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a aria-expanded="false" role="button" href="{{ url('dashboard') }}">首页</a>
                        </li>
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle"
                               data-toggle="dropdown">内容管理 <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="{{url('dashboard/article')}}">所有内容</a></li>
                                <li><a href="{{url('dashboard/recycle')}}">回收站</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('dashboard/category')}}">分类管理</a></li>
                        <li><a href="{{url('dashboard/tags')}}">标签管理</a></li>
                        <li><a href="{{url('dashboard/comment')}}">评论管理</a></li>
                        <li><a href="{{url('dashboard/link')}}">友链管理</a></li>
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle"
                               data-toggle="dropdown">用户管理 <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="{{url('dashboard/admin')}}">后台用户</a></li>
                                <li><a href="{{url('dashboard/user')}}">注册用户</a></li>
        
                            </ul>
                        </li>
                        
                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            
                            <a href="{{ url('/') }}" lass="dropdown-toggle" data-toggle="dropdown"><img src="{{auth('admin')->user()->avatar}}" alt="" class="img-circle" width="20px;" style="margin-right: 5px;">{{auth('admin')->user()->name}}<span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu dropdown-menu-right" style="text-align: right;">
                                <li><a href="{{url('dashboard/info')}}">我的信息</a></li>
                                <li><a href="{{url('dashboard/updateInfo')}}">修改信息</a></li>
                                <li><a href="{{url('dashboard/resetPassword')}}">修改密码</a></li>
                                <li>
                                    <a href="{{ url('dashboard/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        退出登录
                                    </a>
                                    <form id="logout-form"
                                          action="{{ url('dashboard/logout') }}"
                                          method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        
                        
                    </ul>
                </div>
            </nav>
        </div>
        <div class="wrapper wrapper-content animated" style="margin-top: 20px">
            @yield('content')
        </div>
        <div class="footer fixed">
            <div class="pull-right">
                power by <strong>hupo</strong> .
            </div>
            <div>
                <strong>Copyright</strong> Zijin Company &copy; 2017-2018
            </div>
        </div>

    </div>
</div>
</div>

<!-- Mainly scripts -->

<script src="/js/bootstrap.min.js"></script>
<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Flot -->
<script src="/js/plugins/flot/jquery.flot.js"></script>
<script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="/js/plugins/flot/jquery.flot.resize.js"></script>
<!-- ChartJS-->
<!-- Peity -->
<!-- Peity demo -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<script src="/js/plugins/footable/footable.all.min.js"></script>
<!-- iCheck -->
<script src="/js/plugins/iCheck/icheck.min.js"></script>
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script src="/js/plugins/dropzone/dropzone.js"></script>
<script src="/js/jquery.form.js"></script>


<!-- Custom and plugin javascript -->
<script src="/js/inspinia.js"></script>
<script src="/js/plugins/pace/pace.min.js"></script>
<script src="/js/app.js"></script>

@yield('js')

</body>
</html>

