@extends('layouts.app')

@section('jssheet')
<head>
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
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">グループ</label>
                                <div class="col-md-6">
                                    <select name="group" required>
                                        <option value="">グル－プを選択してください</option>
                                        @foreach($joinGroup as $group)
                                        <option value={{ $group['id'] }}>{{ $group['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">スレッドタイトル</label>
                                <div class="col-md-6"><input type="text" required name="title"></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">タグ</label>
                                <div class="col-md-6"><input type="text" id="user-tag"></div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">スレッド概要</label>
                                <div class="col-md-6">
                                    <textarea rows="4" cols="40" class="threadOverviewTextArea" type="textarea" name="threadOverview"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">掲載期間</label>
                                <div class="col-md-6">
                                    <input type="radio" name="period" value="notSpecifyPeriod" checked="checked">指定なし
                                    <input type="radio" name="period" value="specifyPeriod">指定あり
                                </div>
                            </div>
                            
                            <div class="form-group row periodSetting">
                                <label class="col-md-4 col-form-label">掲載開始期間</label>
                                <div class="col-md-6"><input type="datetime-local" name="startAt"></div>
                            </div>

                            <div class="form-group row periodSetting">
                                <label class="col-md-4 col-form-label">掲載終了期間</label>
                                <div class="col-md-6"><input type="datetime-local" name="endAt"></div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('登録') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection