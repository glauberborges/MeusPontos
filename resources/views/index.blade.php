@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <h2>Bem vindo, {{Auth::user()->name}}</h2>
@stop

@section('css')
@stop

@section('js')
@stop
