@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('home.js') }}" defer></script>
<script src="{{ asset('table_list.js') }}" defer></script>
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
                        <button type="button" class="no-decoration-button text-to-the-left dropdown-toggle" onclick="showSerch(this, 'thread-search')">
                        スレッドを検索
                        </button>
                    </div>
                    <div id="thread-search">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">グループ</label>
                                <div class="col-md-6">
                                    <select name="group">
                                        <option value="">グル－プを選択してください</option>
                                        @foreach($groups as $group)
                                        <option value={{ $group['id'] }}>{{ $group['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
    <table id="thread_table" class="list_table" align="center">
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
    
    <!-- ページャーコピー用 -->
    <a id="pager-table-th-clone" class="pager_table_th" href="#" onclick="goNextPage(this);">0</a>
    
    <table id="pager_table" class="pager_table cell-link" align="center">
    </table>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
