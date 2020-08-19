@extends('layouts.app')

@section('jssheet')
<head>
    <script src="{{ asset('group_index.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
    <link href="{{ asset('group_index.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')

<form id = thread_form>
@csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="box">
                            <img class="icon-img" src="{{ $data['resource'] }}" id="icon-image-small">
                            <div class="right">
                                <div>{{ $data['name'] }}</div>
                                <div>{{ $data['description'] }}</div>
                            </div>
                        </div>
                            <ul class="group-nav">
                                <li>基本情報</li><li>スレッド</li><li>メンバー({{ $data['member_count'] }})</li>
                            </ul>
                    </div>

                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection