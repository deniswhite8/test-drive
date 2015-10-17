@extends('layouts.master')

@section('title', 'Laravel')
@section('content')
    <div class="page-header">
        <h1>Laravel 5</h1>
    </div>
    <p class="lead">{{ Inspiring::quote() }}</p>
    <p><a href="http://laravel.com">laravel.com</a></p>
@stop