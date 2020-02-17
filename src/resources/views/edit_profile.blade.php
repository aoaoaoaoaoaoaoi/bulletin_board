@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('edit_tag.js') }}" defer></script>
<script src="{{ asset('edit_profile.js') }}" defer></script>
</head>
@endsection
@section('style')
<head>
<link href="{{ asset('edit_profile.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                    <form id = edit_user_data_form>
                    @csrf
                        <table class="profile">
                            <tr>
                                <td>
                                    <div>Icon</div>
                                    <div><img src="{{ $data['resource'] }}" id="icon-image" onClick="$('#icon-file').click()"></div>
                                    <div><input type="file" name="icon-file" id="icon-file" accept="image/*"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>Name</div>
                                    <div><input type ="text" name="username" id = "username" value = "{{ $data['name'] }}"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>Bio</div>
                                    <div><textarea  rows="4" cols="40" class="bio" name="bio" id = "bio" value = "{{ $data['profile'] }}"></textarea></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>Tag
                                        <span id="user-tag-backs">
                                        @foreach($data['user_tag'] as $d)
                                            <span class="user_tag_back">{{ $d['name'] }}</span>
                                        @endforeach
                                        </span>
                                    </div>
                                    <div>
                                        <input class="user-tag" name="usertag" id="user-tag" type="text" value="{{ $data['user_tag_value'] }}">                                     
                                    </div>
                                </td>
                            </tr>
                            <tr>

                            </tr>
                        </table>
                        <button type="button" class="edit-profile" onclick="update_user_data()">
                                        {{ __('Edit Profile') }}
                        </button>
                    </form>

                    <iframe name="frametest" style="width:0px;height:0px;border:0px;"></iframe>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</div>
@endsection

@section('jquery')
<!--<script src="js/jquery-2.1.1.min.js"></script>-->
    <script>
        //$(".user-tag").val()
    </script>
@endsection