@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <current-league-component></current-league-component>
            <currency-dashboard-component></currency-dashboard-component>
        </div>
    </div>
@endsection
