@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('edit_tag.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
<link href="{{ asset('make_thread.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Make Thread') }}</div>

                    <div class="card-body">
                        <form method="POST" action="./make_thread">
                            @csrf
                            <table class="makeThreadTable">
                                <tr>
                                    <td>
                                        グループ
                                    </td>
                                    <td>
                                        <select name="group" required>
                                            <option value="">グル－プを選択してください</option>
                                            @foreach($joinGroup as $group)
                                            <option value="選択肢1">{{ $group['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        スレッドタイトル
                                    </td>
                                    <td>
                                        <input type="text" required name="title">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        タグ
                                    </td>
                                    <td>
                                        <span id="user-tag-backs"></span>
                                        <input class="user-tag" name="usertag" id="user-tag" type="text">                                    
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        スレッド概要
                                    </td>
                                    <td>
                                        <textarea rows="4" cols="40" class="threadOverviewTextArea" type="textarea" name="threadOverview"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>

            </div>
        </div>
    </div>
</div>

@endsection