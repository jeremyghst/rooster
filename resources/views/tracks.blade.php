@extends('base.layout')
@section('content')
    @foreach ($tracks as $track)
    Track name: {{ $track->name }}  <br>  
        @foreach ($track->rooms as $room)
            <a href="/room/{{ $room->id }}">{{ $room->name }}</a>
        @endforeach
        <br>
    @endforeach
@endsection
