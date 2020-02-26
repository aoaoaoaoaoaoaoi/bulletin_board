@extends('layouts.app')

@section('jssheet')
<head>
<script src="{{ asset('edit_profile.js') }}" defer></script>
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

                            <div>
                            <select name="example" required>
                                <option value="">グル－プを選択してください</option>
                                @foreach($joinGroup as $group)
                                <option value="選択肢1">{{ $group['name'] }}</option>
                                @endforeach
                            </select>
                            </div>

                            <div>
                                スレッドタイトル
                                <input type="text" required>
                            </div>

                            <div>タグ
                                <span id="user-tag-backs">
                                </span>
                            </div>
                            <div>
                                <input class="user-tag" name="usertag" id="user-tag" type="text">                                    
                            </div>

                            <div>
                                スレッド概要
                                <inpu type="textarea">
                            </div>

                            <div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                            </div>
                        </form>
                    </div>

            </div>
        </div>
    </div>
</div>

@endsection