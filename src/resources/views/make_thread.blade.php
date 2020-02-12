@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Make Thread') }}</div>

                    <div class="card-body">
                        <form method="POST" action="./make_group_complete">
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

                            <div>
                                スレッド概要
                                <inpu type="textarea">
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

            </div>
        </div>
    </div>
</div>

@endsection