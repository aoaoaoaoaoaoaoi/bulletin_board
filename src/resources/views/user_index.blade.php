@extends('layouts.app')

@section('jssheet')
<head>
    <script src="{{ asset('join_group.js') }}" defer></script>
    <script src="{{ asset('table_list.js') }}" defer></script>
    <script src="{{ asset('thread_list.js') }}" defer></script>
    <script src="{{ asset('user_index.js') }}" defer></script>
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
                                <div class="name">{{ $data['name'] }}</div>
                            </div>
                        </div>
                            <ul class="group-nav">
                                <li><a class="tab-menu is-active-btn" href="#item1">基本情報</a></li><li><a class="tab-menu" href="#item2">スレッド</a></li><li><a class="tab-menu" href="#item3">参加グループ</a></li>
                            </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-item is-active-item" id="item1">
                            {{ $data['profile'] }}
                        </div>
                        <div class="tab-item" id="item2">
                            @include('partials.thread_list')
                        </div>
                        <div class="tab-item" id="item3">
                            @include('partials.group_list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection