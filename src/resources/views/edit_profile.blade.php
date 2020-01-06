@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                    <form method="POST" action="./edit_profile_complete">
                    @csrf

                        
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