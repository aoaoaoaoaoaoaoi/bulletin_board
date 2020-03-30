@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('edit_tag.js') }}" defer></script>
<script src="{{ asset('make_thread.js') }}" defer></script>
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
                <div class="card-header">{{ __('スレッドの作成') }}</div>

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
                                            <option value={{ $group['id'] }}>{{ $group['name'] }}</option>
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
                                        掲載期間
                                    </td>
                                    <td>
                                        <input type="radio" name="period" value="notSpecifyPeriod" checked="checked">指定なし
                                        <input type="radio" name="period" value="specifyPeriod">指定あり
                                    </td>
                                </tr>

                                <tr class="periodSetting">
                                    <td>
                                       掲載開始期間
                                    </td>
                                    <td>
                                        <input type="datetime-local" name="startAt">
                                    </td>
                                </tr>

                                <tr class="periodSetting">
                                    <td>
                                       掲載終了期間
                                    </td>
                                    <td>
                                        <input type="datetime-local" name="endAt">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('登録') }}
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