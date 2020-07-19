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
                </div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <td rowspan="3">
                                    <img src="{{ $data['createdUserResource'] }}" id="icon-image">
                                </td>
                                <td class="align-left" width ="600px"　height="20px">
                                    <div>1 : {{ $data['createdUser'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-left">
                                    <div>{{ $data['overview'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-left" height="20px">
                                    ✩
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        {{ $data['createdUser'] }}
                                    </td>
                                </th>
                                <th>
                                     {{ $data['overview'] }}
                                </th>
                            </tr>
                            @foreach($data['message'] as $message)
                            <tr>
                                <th>
                                    <td>
                                        {{ $message['thread_order'] }}
                                    </td>
                                    <td>
                                        {{ $message['user_name'] }}
                                        {{ $message['posted_time'] }}
                                    </td>
                                </th>
                                <th>
                                     {{ $message['message'] }}
                                </th>
                            </tr>
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