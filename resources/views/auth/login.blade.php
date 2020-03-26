@extends('layouts.app')

@section('content')
<main>
    <section class="section" id="contact_section">
        <div class="content">
            <div class="contact_form" >
            <h2 class="title_login"><span class="bolder">login</span></h2>

                <form id="login" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">

                    <input type="email" class="full-width" name="email" placeholder="E-Mail Address">
                    {!! csrf_field() !!}


                    <input type="password" class="full-width" class="form-control" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <p><input type="checkbox" name="remember"><span class="text_remember">Remember Me</span> </p>
                    <div class="g-recaptcha" data-sitekey="6LfUvCcTAAAAAIdgqDeswwQa19UDGWRWI1gs7OCm"></div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="submit" value="Login" name="login">
                    <hr class="custom">
                    <a class="btn-login" href="{{ url('/password/reset') }}">Forgot Your <span class="text_bold">Password?</span></a>
                    <a class="btn-login" href="{{ url('/register') }}">Don’t have an account?  <span class="text_bold">Register</span></a>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <hr>
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </form>
            </div>
        </div>

    </section>


</main>
@endsection
@section( 'scripts' )
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
