@extends('layouts.app')

@section('content')
    <h1>SINO?</h1>
@stop

@section('body_section')
    <h1>Si Badjao o si Bulag?</h1>
    
    @if (count($people))
        <ul>
        @foreach($people as $person)

            <li>{{$person}}</li>
        @endforeach
        </ul>
    @endif
        
@stop
@section('footer')

<!-- <script>alert('Hello nigga')</script> -->

@stop