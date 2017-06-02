<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   @yield('title')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="/css/solar/bootstrap.css" rel="stylesheet">
    <link href="/css/solar/hupo.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'user_id'=>auth()->check()?auth()->user()->id:'',
            'user_avatar'=>auth()->check()?auth()->user()->avatar:'',
            'user_name'=>auth()->check()?auth()->user()->name:'',
        ]); ?>;
    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Mycentos</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/" id="nav-0">首页</a>
                </li>
                @foreach($category as $v)
                    <li id="nav-{{$v->id}}">
                        <a href="{{url('/categoryies',$v->id)}}">{{$v->name}}</a>
                    </li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <div class="btn-group">
                        <img src="{{auth()->user()->avatar}}"
                             data-toggle="dropdown"
                             aria-haspopup="true"
                             aria-expanded="false"
                             class="dropdown-toggle"
                             alt=""
                             style="width: 40px;border-radius: 20px;margin-top: 5px;cursor: pointer;">
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ url('/') }}">{{auth()->user()->name}}</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    退出
                                </a>
                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <li>
                        <a href="{{ route('login') }}">登录</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<header style="margin-top: 50px">
    
    <div class="jumbotron">
        
        <div class="container text-center">
            <h1>Mycentos</h1>
            <p>学习,记录,分享</p>
            <form class="navbar-form" role="search" method="get" action="{{url('/search')}}">
                <div class="form-group {{ $errors->has('q') ? ' has-error' : '' }}">
                    <input type="text" class="form-control form-inline" name="q" placeholder="Search...">
                    @if ($errors->has('q'))
                        <span class="help-block">
                        <strong>{{$errors->first('q') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group" style="vertical-align: top;">
                    <button type="submit" class="btn btn-default ">搜索</button>
                
                </div>
            
            </form>
        </div>
    </div>
</header>
@yield('content')
<footer>
    <div class="container-fluid" style="background: #073642;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2>友情链接</h2>
                    <ul>
                        @foreach($links as $link)
                            <li>
                                <a href="{{$link->url}}">{{$link->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h2>关于我</h2>
                    <p>
                        从事PHP编程工作5+年,熟悉Html,Css,JS等前端技术,喜欢在LNMP环境下开发PHP项目.
                        喜欢打篮球,喜欢去旅游!
                    </p>
                </div>
                <div class="col-lg-4 text-center">
                    <h2>联系我</h2>
                    <p>IT从业者,专注PHP开发,欢迎交流</p>
                    <span>
                        <img src="/images/mmqrcode.png" alt="" style="width: 200px;margin-top: 30px;">
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h4><strong>© Mycentos 2017. All rights reserved.</strong>Developed By hupo,Powered By Laravel
                    </h4>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="/js/jquery-2.1.1.js"></script>
<script src="/js/jquery.form.js"></script>
<script src="/js/bootstrap.min.js"></script>
@yield('js')

</body>
</html>