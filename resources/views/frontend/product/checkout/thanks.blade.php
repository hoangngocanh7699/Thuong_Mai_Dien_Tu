@extends('frontend.layouts.master')

@section('title')
    <title> E-Shopper</title>
@endsection

@section('css')
    <link href="{{asset('home-frontend/home.css')}}" rel="stylesheet">

@endsection

@section('js')
    <script src="{{asset('home-frontend/home.js')}}"></script>

@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.components.sidebar')
                <div class="col-sm-9 padding-right cart-wrapper">
                    <div class="row" style="margin-bottom: 30rem">

                        <div class="breadcrumbs">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Home</a></li>
                                <li class="active">Thanh toán</li>
                            </ol>
                        </div><!--/breadcrums-->

                        <h2 style="text-transform: uppercase">Đơn hàng của bạn đang được xử lý, chúng tôi sẽ liên hệ tới bạn sớm nhất</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection





