@extends('layouts.app')

@section('jssheet')
<head>
<!-- <script src="{{ asset('edit_tag.js') }}" defer></script> -->
<script src="{{ asset('thread.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
<link href="{{ asset('thread_index.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h1>{{ $data['title'] }}</h1>
                    </div>
                    <div>
                        @if($data['endAt'] != "")
                            {{ $data['endAt'] }}まで
                        @endif
                    </div>
                    <div>
                        @foreach($data['tags'] as $tag)
                            {{ $tag }}
                        @endforeach
                    </div>

                    <div class="box">
                        <img src="{{ $data['createdUserResource'] }}" id="icon-image-small">
                        <div class="right">
                            <div class="name">
                                1 : {{ $data['createdUser'] }}
                            </div>
                            <div class="overview">
                                {{ $data['overview'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @foreach($data['message'] as $message)
                    <div class="box bottom-line">
                        <img src="{{ $data['createdUserResource'] }}" id="icon-image-small">
                        <div class="right">
                            <div class="name">
                                {{ $loop->iteration }} : {{ $message['user_name'] }} {{ $message['posted_time'] }}
                            </div>
                            <div>
                                {{ $message['message'] }}
                            </div>
                            <div>
                                @if($message['resource1'] != null)
                                    <img class="message-image" src="{{ $message['resource1'] }}">
                                @endif
                                @if($message['resource2'] != null)
                                    <img class="message-image" src="{{ $message['resource2'] }}">
                                @endif
                                @if($message['resource3'] != null)
                                    <img class="message-image" src="{{ $message['resource3'] }}">
                                @endif
                            </div>
                            <div class="reaction-button">
                            @if($message['is_good_reaction'])
                                <div class="first-reaction-button"><button type="button" class="good-button good-button-color no-decoration-button" value={{ $message['thread_message_id'] }}>♡{{ $message['good_reaction'] }}</button></div>
                            @else
                                <div class="first-reaction-button"><button type="button" class="good-button no-decoration-button" value={{ $message['thread_message_id'] }}>♡{{ $message['good_reaction'] }}</button></div>
                            @endif
                            @if($message['is_great_good_reaction'])
                                <div class="second-reaction-button"><button type="button" class="great-good-button great-good-button-color no-decoration-button" value={{ $message['thread_message_id'] }}>✩{{ $message['great_good_reaction'] }}</button></div>
                            @else   
                                <div class="second-reaction-button"><button type="button" class="great-good-button no-decoration-button" value={{ $message['thread_message_id'] }}>✩{{ $message['great_good_reaction'] }}</button></div>
                            @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div>
                        <textarea rows="4" cols="40" class="message-textarea" type="textarea" name="sendMessage" id = "messageText" placeholder="スレに投稿" ></textarea>
                        <div id="message-images"></div>
                        <label for="message-file" class="add-image-button">
                            ＋ファイルを選択
                            <input multiple="multiple" class="add-image-button no-decoration-button" type="file" name="message-file" id="message-file" accept="image/*" style="display:none;">
                        </label>
                        <button type='button' class="btn btn-primary send-message-button" onclick="sendMessage(this)">送信</button>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection