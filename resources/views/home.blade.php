@extends('layouts.app')
@section('content')
<style>
    .message-item {
        margin-bottom: 25px;
        margin-left: 40px;
        position: relative;
    }
    .message-item .message-inner {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 10px;
        position: relative;
    }
    .message-item .message-inner:before {
        border-right: 10px solid #ddd;
        border-style: solid;
        border-width: 10px;
        color: rgba(0,0,0,0);
        content: "";
        display: block;
        height: 0;
        position: absolute;
        left: -20px;
        top: 6px;
        width: 0;
    }
    .message-item .message-inner:after {
        border-right: 10px solid #fff;
        border-style: solid;
        border-width: 10px;
        color: rgba(0,0,0,0);
        content: "";
        display: block;
        height: 0;
        position: absolute;
        left: -18px;
        top: 6px;
        width: 0;
    }
    .message-item:before {
        background: #fff;
        border-radius: 2px;
        bottom: -30px;
        box-shadow: 0 0 3px rgba(0,0,0,0.2);
        content: "";
        height: 100%;
        left: -30px;
        position: absolute;
        width: 3px;
    }
    .message-item:after {
        background: #fff;
        border: 2px solid #ccc;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        content: "";
        height: 15px;
        left: -36px;
        position: absolute;
        top: 10px;
        width: 15px;
    }
    .clearfix:before, .clearfix:after {
        content: " ";
        display: table;
    }
    .message-item .message-head {
        border-bottom: 1px solid #eee;
        margin-bottom: 8px;
        padding-bottom: 8px;
    }
    .message-item .message-head .avatar {
        margin-right: 20px;
    }
    .message-item .message-head .user-detail {
        overflow: hidden;
    }
    .message-item .message-head .user-detail h5 {
        font-size: 16px;
        font-weight: bold;
        margin: 0;
    }
    .message-item .message-head .post-meta {
        float: left;
        padding: 0 15px 0 0;
    }
    .message-item .message-head .post-meta >div {
        color: #333;
        font-weight: bold;
        text-align: right;
    }
    .post-meta > div {
        color: #777;
        font-size: 12px;
        line-height: 22px;
    }
    .message-item .message-head .post-meta >div {
        color: #333;
        font-weight: bold;
        text-align: right;
    }
    .post-meta > div {
        color: #777;
        font-size: 12px;
        line-height: 22px;
    }
    img {
        min-height: 40px;
        max-height: 40px;
    }
</style>

<div class="container-fluid p-4">
    <div class="col-md-12">
        <h2>Bulletin Board</h2>
    </div>
    @if(empty($posts->toArray()))
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Posts</div>
            <div class="panel-body">
                <center><strong>No post yet!</strong></center>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-12">
        <div class="qa-message-list" id="wallmessages">
            @foreach($posts as $post)
            <div class="message-item">
                <div class="message-inner">
                    <div class="message-head clearfix">
                        <div class="avatar pull-left"><img src="{{ asset('images/dummy_character.png') }}"></div>
                        <div class="user-detail">
                            <h5 class="handle">{{$post->title}}</h5>
                            <div class="post-meta">
                                <div class="asker-meta">
                                    <span class="qa-message-what"></span>
                                    <span class="qa-message-when">
                                        <span class="qa-message-when-data">{{date_format($post->updated_at,"F m, Y") }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="qa-message-content">
                        <p>{{$post->description}}</p>
                        <hr>
                        @if(!empty($post->attachment))
                        <p>Attachment : <a href="{{url('files/'.$post->attachment)}}" target="_blank">Download</a></p>
                        @else
                        <p>No Attachment</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
