@extends('layouts.app')

@section('content')
<section class="section" id="contact_section">
    <div class="content">
        <div class="contact_form" >
            <h2 class="title_login"><span class="bolder">Register</span></h2>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ isset($errors) && $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="name" placeholder="Name" value="">

                        @if (isset($errors) && $errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('email') ? ' has-error' : '' }}">

                        <input type="email" class="form-control"  placeholder="E-Mail Address"  name="email" value="">

                        @if (isset($errors) && $errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('password') ? ' has-error' : '' }}">

                        <input type="password" class="form-control" placeholder="Password" name="password">

                        @if (isset($errors) && $errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('password_confirmation') ? ' has-error' : '' }}">

                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">

                        @if (isset($errors) && $errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="submit" name="register" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
