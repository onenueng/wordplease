@extends('auth.auth')
@section('doc_title')
Sign in
@endsection
@section('content')
<br><br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Sign in to continue to IPD Note</div>
                <div class="panel-body">
                    @include('errors.invalid')

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">SAP ID :</label>
                            <div class="col-md-6">
                                <!-- <input type="email" class="form-control" name="email" value="{{ old('email') }}"> -->
                                <!-- <input class="form-control" name="username" value="{{ old('username') }}"> -->
                                <input class="form-control" name="sap_id" value="{{ old('sap_id') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password :</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <!-- 
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                         -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                                <a class="btn btn-link" href="{{ url('/auth/register') }}">or Register a new one.</a>
                                <!-- <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a> -->
                            </div>
                            <!-- <div class="col-md-6 col-md-offset-4">
                                <a class="btn btn-link" href="{{ url('/auth/register') }}">Create Account</a>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection