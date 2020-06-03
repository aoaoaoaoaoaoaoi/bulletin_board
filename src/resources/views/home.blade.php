@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('home.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
<link href="{{ asset('home.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div>
                        <button type="button" class="no-decoration-button text-to-the-left dropdown-toggle" onclick="showSerch(this)">
                        スレッドを検索
                        </button>
                    </div>
                    <div id="thread-search">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">タイトル</label>
                            <div class="col-md-6"><input type="text"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">タグ</label>
                            <div class="col-md-6"><input type="text"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">開始日</label>
                            <div class="col-md-6 parallel"><input type="date">～<input type="date"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">終了日</label>
                            <div class="col-md-6 parallel"><input type="date">～<input type="date"></div>
                        </div>
                        <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                        <button type="button" id="searchButton" class="btn btn-primary" onclick="showSerch(this)">
                                    検索
                        </button>
</div>
</div>
                    </div>
                    </div>
                <div class="card-body">
    <table class="thread_table">
        <tr>
            <th>
                タイトル
            </th>
            <th>
                更新日時
            </th>
            <th>
                終了日時
            </th>
            <th>
                波
            </th>
            <th>
                開設日時
            </th>
        </tr>
        @foreach($data as $thread)
            <tr>
                <td>
                    <a id="thread-index" href="./thread?threadId={{ $thread['id'] }}">
                            {{ $thread['title'] }} 
                    </a>
                </td>
                <td>
                    {{ $thread['updatedAt'] }} 
                </td>
                <td>
                    {{ $thread['endAt'] }} 
                </td>
                <td>
                    {{ $thread['wave'] }} 
                </td>
                <td>
                    {{ $thread['startAt'] }} 
                </td>
            </tr>
        @endforeach
    </table>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
