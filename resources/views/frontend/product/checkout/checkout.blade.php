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

                        <div class="shopper-informations">
                            <div class="row">

                                <div class="col-sm-12 clearfix">
                                    <div class="bill-to">
                                        <p>Điền thông tin gửi hàng</p>
                                        <div class="form-two">
                                            <form action="{{route('product.savecheckoutcustomer')}}" method="post">
                                                @csrf
                                                <input name="email" type="text" placeholder="Email">
                                                <input name="name" type="text" placeholder="Họ và tên">
                                                <input name="address" type="text" placeholder="Địa chỉ">
                                                <input name="phone" type="text" placeholder="Phone">
                                                <textarea name="note"
                                                          placeholder="Ghi chú cho đơn hàng của bạn"
                                                          rows="16"></textarea>
                                                <button type="submit" class="btn btn-primary">Gửi</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection





