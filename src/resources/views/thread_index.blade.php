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
                <div class="card-header">
                    <div>
                        {{ $data['title'] }}
                    </div>
                    <div>
                        {{ $data['createdUser'] }}
                    </div>
                    <div>
                        {{ $data['overview'] }}
                    </div>
                    <div>
                        @foreach($data['tags'] as $tag)
                            {{ $tag }}
                        @endforeach
                    </div>
                    <div>
                        書き込み締め切り
                        {{ $data['endAt'] }}
                    </div>
                </div>

                    <div class="card-body">
                        
                    </div>

            </div>
        </div>
    </div>
</div>

@endsection