@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="widget-head-color-box navy-bg p-lg text-center">
                <div class="m-b-md">
                    <h2 class="font-bold no-margins">
                        {{auth('admin')->user()->name}}
                    </h2>
                    <small>{{auth('admin')->user()->email}}</small>
                </div>
                @if(auth('admin')->user()->avatar)
                <img src="{{auth('admin')->user()->avatar}}" class="img-circle circle-border m-b-md" alt="profile" style="width: 80px">
                @endif
            </div>
        </div>
    </div>
    
</div>
@endsection
