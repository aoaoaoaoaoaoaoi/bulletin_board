@extends('layouts.app')

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
                        <table>
                            <tr>
                                <!--<td><button type="button" class="icon-image"></td>-->
                                <td>
                                <img src="" class="icon-image" onclick="clickIcon()" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                            </tr>
                            <tr>
                                <td><input type ="text" name="username" value = "{{ $data['name'] }}"></td>
                            </tr>
                            <tr>
                                <td>Bio</td>
                            </tr>
                            <tr>
                                <td><input type ="text" name="profile" value = "{{ $data['profile'] }}"></td>
                            </tr>
                            <tr>
                                <td>Tag</td>
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