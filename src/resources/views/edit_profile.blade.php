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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                    <form method="POST" action="./edit_profile_complete">
                    @csrf
                        <table class="profile">
                            <tr>
                                <td>
                                    <div>Icon</div>
                                    <div><img src="../../../icon_image/icon.png" id="icon-image" onClick="$('#icon-file').click()"></div>
                                    <div><input type="file" name="icon-file" id="icon-file" accept="image/*"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>Name</div>
                                    <div><input type ="text" name="username" value = "{{ $data['name'] }}"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>Bio</div>
                                    <div><textarea  rows="4" cols="40" class="bio" name="bio" value = "{{ $data['profile'] }}"></textarea></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>Tag
                                        <div id="user-tag-backs">
                                        @foreach($data['user_tag'] as $d)
                                            <span class="user_tag_back">{{ $d['name'] }}</span>
                                        @endforeach
                                        </div>
                                        <div>
                                            <input class="user-tag" id="user-tag" type="text" value="{{ $data['user_tag_value'] }}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>

                            </tr>
                        </table>
                        <button type="submit" class="edit-profile">
                                        {{ __('Edit Profile') }}
                        </button>
                    </form>
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