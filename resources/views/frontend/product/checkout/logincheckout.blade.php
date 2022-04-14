@extends('frontend.layouts.master')

@section('title')
    <title> E-Shopper</title>
@endsection

@section('css')
    <link href="{{asset('home-frontend/home.css')}}" rel="stylesheet">

@endsection

@section('js')
    <script src="{{asset('home-frontend/home.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.components.sidebar')
                <div class="col-sm-9 padding-right cart-wrapper">
                    <div class="row" style="margin-bottom: 30rem">
                        <div class="col-sm-4 col-sm-offset-1">
                            @if (\Session::has('message_login'))
                                <div class="alert alert-danger alert-block" role="alert">
                                    {!! \Session::get('message_login') !!}</ul>
                                </div>

                            @endif
                            <div class="login-form"><!--login form-->
                                <h2>Đăng nhập vào tài khoản</h2>
                                <form action="{{route('product.loginCustomer')}}" method="post">
                                    @csrf
                                    <input type="text" name="email" placeholder="Tài khoản" required>
                                    <input type="password" name="password" placeholder="Mật khẩu" required>
                                    <span>
{{--								<input type="checkbox" class="checkbox">--}}
{{--								Ghi nhớ đăng nhập--}}
							</span>
                                    <button type="submit" class="btn btn-default">Đăng nhập</button>

                                </form>
                            </div><!--/login form-->
                        </div>
                        <div class="col-sm-1">
                            <h2 class="or">Hoặc</h2>
                        </div>
                        <div class="col-sm-4">
                            @if($errors->has('g-recaptcha-response'))
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->first('g-recaptcha-response')}}
                                </div>
                            @endif
                            @if (\Session::has('message'))
                                <div class="alert alert-success alert-block" role="alert">
                                    {!! \Session::get('message') !!}</ul>
                                </div>

                            @endif
                            <div class="signup-form"><!--sign up form-->
                                <h2>Đăng ký</h2>
                                <form action="{{route('product.addCustomer')}}" method="post">
                                    @csrf
                                    <input name="name" type="text" placeholder="Họ và tên" required>
                                    <input name="email" type="email" placeholder="Email" required>
                                    <input name="password" type="password" placeholder="Mật khẩu" required>
                                    <input name="phone" type="text" placeholder="Số điện thoại" required>
                                    <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                                    <button type="submit" class="btn btn-default">Đăng ký</button>
                                </form>
                            </div><!--/sign up form-->


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection





