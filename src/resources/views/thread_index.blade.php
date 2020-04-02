@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('edit_tag.js') }}" defer></script>
<script src="{{ asset('thread.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
<link href="{{ asset('thread.css') }}" rel="stylesheet">
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
                        {{ $data['endAt'] }}まで
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
                        </table>
                    <div>
                    <textarea rows="4" cols="40" class="sendMessage" type="textarea" name="sendMessage"></textarea>
                    <button type='button' class='sendMessage'>send</button>
                      
                </div>

            </div>
        </div>
    </div>
</div>

@endsection