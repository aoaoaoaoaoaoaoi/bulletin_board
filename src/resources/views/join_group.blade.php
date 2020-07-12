@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('join_group.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
<link href="{{ asset('join_group.css') }}" rel="stylesheet">
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
                        グループを検索
                        </button>
                    </div>
                    <div id="thread-search">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">グループ名</label>
                            <div class="col-md-6"><input type="text" id="title"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">タグ</label>
                            <div class="col-md-6"><input type="text" id="tag"></div>
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
                アイコン
            </th>
            <th class="width-bigger" align="center">
                グループ名
            </th>
            <th class="width-little-little-bigger" align="center">
                詳細
            </th>
            <th class="width-little-little-bigger" align="center">
                参加しているかどうか
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

@section('content')
<div class="container">
    <table>
        <tr>
            <td>
                グループ名
                <input type="text">
            </td>
            <td>
                タグ
                <input type="text">
            </td>
        </tr>
    </table>

    <ul class="group-tables">
        <li class="group-state-select">
            <table border="1px">
                <tr><th>参加しているグループ</th><tr>
                <tr><th>参加していないグループ</th><tr>
            </table>
        </li>
        <li class="others">
            <div>
                <form method="POST" action="./join_group_complete">
                @csrf
                    <table class="join-group" border="1px">
                        <tr class="join-group">
                            <th>グループ名</th>
                            <th>説明</th>
                            <th>参加する？</th>
                            <th>詳細</th>
                        </tr>
                        
                        @foreach ($data as $d)
                        <tr class="join-group">
                            <td>{{ $d['name'] }}</td>
                            <td>{{ $d['description'] }}</td>
                            <td>
                                @if (!$d['isJoin'])
                                    <input type="checkbox" name="isJoin[]" value={{ $d['id'] }}>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" id="group-detail-button" onclick="showInfo(this)" value={{ $d['id'] }}>
                                    {{ __('View Detail') }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">
                                <button type="submit" class="join-group">
                                                グループに参加する
                                </button>
                            </td>
                        <tr>
                    </table>
                </form>
            </div>
            <div class="card">
                <table class="join-group">
                    <tr>
                        <td colspan="4">グループ詳細</td>
                    </tr>
                        <tr class="join-group">
                            <th>name</th>
                            <th>description</th>
                            <th>group member</th>
                        </tr>
                        <tr class="join-group">
                            <td id="group-detail-name"></td>
                            <td id="group-detail-description"></td>
                            <td id="group-detail-members"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </li>
    </ul>
</div>

@endsection