@extends('layouts.bulletin_default')

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
    <!-- <label>
    <span>popupを表示</span>
    <input type="checkbox" name="checkbox">
    <div id="popup">aaaaaaaa</div>
</label>-->
</div>

@endsection