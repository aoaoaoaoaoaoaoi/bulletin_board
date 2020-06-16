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
                            <div class="col-md-6"><input type="text" id="title"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">タグ</label>
                            <div class="col-md-6"><input type="text" id="tag"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">開始日</label>
                            <div class="col-md-6 parallel"><input type="date" id="start-date-start">～<input type="date" id="start-date-end"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">終了日</label>
                            <div class="col-md-6 parallel"><input type="date" id="end-date-start">～<input type="date" id="end-date-end"></div>
                        </div>
                        <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                        <button type="button" id="searchButton" class="btn btn-primary" onclick="search(this)">
                                    検索
                        </button>
</div>
</div>
                    </div>
                    </div>
                <div class="card-body">
    <table id="thread_table" class="thread_table" align="center">
        <tr>
            <th class="width-little-bigger" align="center">
                更新日
            </th>
            <th class="width-bigger" align="center">
                タイトル
            </th>
            <th class="width-little-little-bigger" align="center">
                波
            </th>
            <th class="width-little-little-bigger" align="center">
                グループ
            </th>
        </tr>
    </table>
    <div id="loading-message" align="center">
        <h1>Now Loading ...</h1>
    </div>
    <div class="dummy">blank </div>
    <table id="pager_table" class="pager_table" align="center">
        <tr>
            <!--@foreach($pageCount as $page)
                <th><button type="button" class="no-decoration-button" onclick="goNextPage(this)">{{ $page }}</button></th>
            @endforeach-->
        <tr>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
