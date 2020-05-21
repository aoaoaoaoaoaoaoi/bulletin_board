@extends('layouts.bulletin_default')

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
    <form id = edit_user_data_form>
    @csrf
    <ul class="profile-tables">
        <li>
            <table>        
                <tr>
                    <td>
                        <div><img src="{{ $data['resource'] }}" id="icon-image" onClick="$('#icon-file').click()"></div>
                        <div><input type="file" name="icon-file" id="icon-file" accept="image/*"></div>
                    </td>
                </tr>
            </table>
        </li>
        <li>
            <table>     
                <tr>
                    <td>
                        <div>ユーザー名</div>
                        <div><input type ="text" name="username" id = "username" value = "{{ $data['name'] }}"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>説明</div>
                        <div><textarea  rows="4" cols="40" class="bio" name="bio" id = "bio" value = "{{ $data['profile'] }}"></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>タグ
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
                    <td>
                        <button type="button" class="submit-btn" onclick="update_user_data()">
                                        保存
                        </button>
                    </td>
                </tr>
            </table> 
        </li>
    </ul>
    </form>
@endsection

@section('jquery')
<!--<script src="js/jquery-2.1.1.min.js"></script>-->
    <script>
        //$(".user-tag").val()
    </script>
@endsection