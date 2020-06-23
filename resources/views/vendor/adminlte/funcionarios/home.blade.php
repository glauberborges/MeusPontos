@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @php(dump(session()->all()))

    <p>Welcome to this beautiful FUNCIONARIO panel.</p>
@stop

@section('css')
@stop

@section('js')
@stop
