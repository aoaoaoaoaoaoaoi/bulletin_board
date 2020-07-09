@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('edit_profile.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
<link href="{{ asset('edit_profile.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')
    <form id = edit_user_data_form>
    @csrf
    <div class="profile-tables">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    プロフィールの設定
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label  text-md-right">イメージ</label>
                        <div class="col-md-6 originalFileBtn"><img src="{{ $data['resource'] }}" id="icon-image" onClick="$('#icon-file').click()">
                        <input class="no-back" type="file" name="icon-file" id="icon-file" accept="image/*" style="display:none;"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label  text-md-right">ユーザー名</label>
                        <div class="col-md-6"><input type ="text" name="username" id = "username" value = "{{ $data['name'] }}"></div>
                    </div>
                    <div class="form-group row">    
                        <label class="col-md-4 col-form-label  text-md-right">説明</label>
                        <div class="col-md-6"><textarea rows="4" cols="40" class="bio" name="bio" id = "bio" value = "{{ $data['profile'] }}"></textarea></div>
                    </div>        
                    <div class="form-group row"> 
                        <label class="col-md-4 col-form-label  text-md-right">タグ</label>
                        <div class="col-md-6"><input class="user-tag" name="usertag" id="user-tag" type="text" value="{{ $data['user_tag_value'] }}"></div>                                
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="button" class="btn btn-primary width-large" onclick="update_user_data()">
                                            保存
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </form>
@endsection

@section('jquery')
@endsection