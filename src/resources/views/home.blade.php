@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table border="0">
                        <tr>
                            <th>
                                You are logged in!
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <a id="make-group" href="./make_group">
                                        Make a Group
                                </a>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <a id="join-group" href="./join_group">
                                        Join a Group
                                </a>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
