@extends('layouts.bulletin_default')

@section('jssheet')
<head>
<script src="{{ asset('join_group.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
<link href="{{ asset('login.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <!-- <table><tr> -->
                <div class="card-header">{{ __('Join Group') }}</div>

                    <div class="card-body">
                    <!-- テーブルの中の情報をそのまま表示する -->

                    <form method="POST" action="./join_group_complete">
                    @csrf

                        <table class="join-group">
                            <tr class="join-group">
                                <th>group name</th>
                                <th>group description</th>
                                <th>join?</th>
                                <th>View Detail Button</th>
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
<!-- </tr> -->
<!-- <tr> -->

            <!-- </tr></table> -->

        </div>
    </div>
</div>

@endsection