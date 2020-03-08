@extends('layouts.basic')

@section('link')
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/register.css')}}">
    <style>
        .error {
            color: red;
        }
    </style>
@endsection
@section('leftsidebar')
    <div class="col-md-2 col-sm-2"></div>
@endsection

@section('content')
    <div class="col-md-8 login_body mt-3">
        <h2>Register</h2>

        <div class="row">
            <div class="invalid_box">
                <div class="right_img"><img alt="" src="/images/cross_img.png"></div>
                <span>

                </span></div>
        </div>

        <div class="row login_box">
            <div class="col-md-12 register_title">
                <h5>By signing up I agree to Gopiko's <a href="/static/terms-of-use">Terms of Use</a> and <a
                        href="/static/privacy-policy">Privacy Policy</a> and I consent to receiving marketing from
                    Tipsmate.</h5>
            </div>

            <div class="col-xs-12 col-sm-6 social-login-mobile-body">
                <div class="text-center social-btn">
                    {{--                    <form method="post" class="facebook_login_form" action="register"><span for="btn_cta"--}}
                    {{--                                                                                                     class="btn-icon">--}}
                    {{--                                                                                    <span class="left-panel"></span>--}}
                    {{--                                                                                    <input type="submit"--}}
                    {{--                                                                                           name="facebook-login"--}}
                    {{--                                                                                           class="btn btn-primary btn-block"--}}
                    {{--                                                                                           value="Register with Facebook"/></span>--}}
                    {{--                    </form>--}}
                    {{--                    <form method="post" class="google_login_form" action="register">--}}
                    {{--                                                        <span for="btn_cta" class="btn-icon">--}}
                    {{--                                                            <span class="left-panel"></span>--}}
                    {{--                                                            <input type="submit" name="google-login"--}}
                    {{--                                                                   class="btn btn-danger btn-block"--}}
                    {{--                                                                   value="Register with Google&nbsp;&nbsp;&nbsp;&nbsp;"/></span>--}}
                    {{--                    </form>--}}
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    <br>
                @endif
                <form name="frm" id="frm" method="post" action="/register" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Email Address" name="email" id="email"
                               class="form-control border-radius"><span
                            class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Your First Name" name="name" id="ame"
                               class="form-control border-radius required"><span
                            class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" id="password"
                               class="form-control border-radius"><span
                            class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirm Password" name="password_confirmation"
                               id="password_confirmation" class="form-control border-radius"><span
                            class="text-danger">{{ $errors->first('confirm_password') }}</span>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{env('CAPTHA_KEY')}}"></div>
                        @if($errors->has('g-recaptcha-response'))
                            <span style="color: #ef3333">{{ $errors->first('g-recaptcha') }}</span>
                        @endif

                    </div>

                    <div class="form-group">

                        <input id="btnSubmit" name="btnSubmit"
                               class="btn btn-primary full-width red-bg border-none border-radius3" type="submit"
                               value="Sign Up"/>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <span style="color: #353535">Already registered with Tipsmate? <a href="/login"
                                                                                          class="c-login-link">Sign in</a></span>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-sm-6 pl-lg social-login-desktop-body">
                <div class="text-center social-btn">
                    <form method="post" class="facebook_login_form" action="/register"><span for="btn_cta"
                                                                                             class="btn-icon">
                                    <span class="left-panel"></span>
                                                                <input type="submit" name="facebook-login"
                                                                       class="btn btn-primary btn-block f-btn"
                                                                       value="Register with Facebook"/></span></form>
                    <form method="get" class="google_login_form" action="auth/google">
                        @csrf
                        <span for="btn_cta" class="btn-icon">
                            <span class="left-panel"></span>
                            <input type="submit" name="google-login" class="btn btn-danger btn-block" value="Register with Google&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        </span>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
@endsection
