 
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



