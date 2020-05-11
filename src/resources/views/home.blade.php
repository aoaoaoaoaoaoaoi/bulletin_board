@extends('layouts.bulletin_default')

@section('style')
<head>
<link href="{{ asset('home.css') }}" rel="stylesheet">
</head>
@endsection

@section('content')
<div>
    <table>
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
        @foreach($data['threads'] as $thread)
            <tr>
                <td>
                    <a id="thread-index" href="./thread?threadId={{$thread->id}}">
                            {{$thread->title}} 
                    </a>
                </td>
                <td>
                    <!-- {{$thread->updated_at}} --> 
                </td>
                <td>
                    {{$thread->end_at}} 
                </td>
                <td>
                    
                </td>
                <td>
                    {{$thread->start_at}} 
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
