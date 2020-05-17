@extends('layouts.bulletin_default')

@section('style')
<head>
<link href="{{ asset('home.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')
<div>
    <table class="thread_table">
        <tr>
            <th>
                タイトル
            </th>
            <th>
                更新日時
            </th>
            <th>
                終了日時
            </th>
            <th>
                波
            </th>
            <th>
                開設日時
            </th>
        </tr>
        @foreach($data as $thread)
            <tr>
                <td>
                    <a id="thread-index" href="./thread?threadId={{ $thread['id'] }}">
                            {{ $thread['title'] }} 
                    </a>
                </td>
                <td>
                    {{ $thread['updatedAt'] }} 
                </td>
                <td>
                    {{ $thread['endAt'] }} 
                </td>
                <td>
                    {{ $thread['wave'] }} 
                </td>
                <td>
                    {{ $thread['startAt'] }} 
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
