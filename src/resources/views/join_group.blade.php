@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Join Group') }}</div>

                    <div class="card-body">
                    <!-- テーブルの中の情報をそのまま表示する -->
                    
                    @csrf

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection