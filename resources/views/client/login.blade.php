@extends('layouts.master')

@section('title', 'Log in to Admin Panel')
@section('page-class', 'login-page')
@section('content')
    <form class="form-signin">
        <h2 class="form-signin-heading">Log in</h2>
        <label for="email" class="sr-only">Email</label>
        <input type="email" id="email" class="form-control" placeholder="Email" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
    </form>
@stop