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
            </table>

            <button type="submit" class="join-group">
                            {{ __('Join Groups') }}
            </button>
        </form>
    </div>
    <div class="card">
        <div class="card-header">{{ __('Group Detail') }}</div>
        <div class="card-body">
            <table class="join-group">
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
</div>

@endsection