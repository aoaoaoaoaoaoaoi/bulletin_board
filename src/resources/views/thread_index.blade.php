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
                            <div class="reaction-button">
                                <div class="first-reaction-button"><button type="button" class="good-button no-decoration-button" value={{ $message['thread_message_id'] }}>♡{{ $message['good_reaction'] }}</button></div>
                                <div class="second-reaction-button"><button type="button" class="great-good-button no-decoration-button" value={{ $message['thread_message_id'] }}>✩{{ $message['great_good_reaction'] }}</button></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div>
                        <textarea rows="4" cols="40" class="sendMessage" type="textarea" name="sendMessage" id = "messageText"></textarea>
                        <button type='button' class='sendMessage' onclick="sendMessage(this)">send</button>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection