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

                    <table>
                            <tr>
                                <td rowspan="3">
                                    <img src="{{ $data['createdUserResource'] }}" id="icon-image-small">
                                </td>
                                <td class="align-left name" width ="600px"　height="20px">
                                    <div>1 : {{ $data['createdUser'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-left overview">
                                    <div>{{ $data['overview'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-left" height="20px">
                                    ✩
                                </td>
                            </tr>
                    </table>
                </div>

                    <div class="card-body">

                        <table>
                            @foreach($data['message'] as $message)
                            <tr>
                                <td rowspan="3">
                                    <img src="{{ $data['createdUserResource'] }}" id="icon-image-small">
                                </td>
                                <td class="align-left name" width ="600px"　height="20px">
                                    <div>{{ $loop->iteration }} : {{ $message['user_name'] }} {{ $message['posted_time'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-left">
                                    <div>{{ $message['message'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-left" height="20px">
                                    ✩
                                </td>
                            </tr>
                            @if (!$loop->last)
                            <tr>
                                <hr>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    <div>
                    <textarea rows="4" cols="40" class="sendMessage" type="textarea" name="sendMessage" id = "messageText"></textarea>
                    <button type='button' class='sendMessage' onclick="sendMessage(this)">send</button>   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection