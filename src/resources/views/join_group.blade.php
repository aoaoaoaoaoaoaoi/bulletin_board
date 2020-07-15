@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('join_group.js') }}" defer></script>
<script src="{{ asset('table_list.js') }}" defer></script>
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
                        <button type="button" class="no-decoration-button text-to-the-left dropdown-toggle" onclick="showSerch(this, 'group-search')">
                        グループを検索
                        </button>
                    </div>
                    <div id="group-search">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">グループ名</label>
                            <div class="col-md-6"><input type="text" id="title"></div>
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
                    <table id="group_table" class="list_table" align="center">
                        <tr>
                            <th class="width-150" align="center">
                                アイコン
                            </th>
                            <th class="width-100" align="center">
                                グループ名
                            </th>
                            <th class="width-50" align="center">
                                人数
                            </th>
                            <th class="width-250" align="center">
                                詳細
                            </th>
                            <th class="width-100" align="center">
                                状態
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