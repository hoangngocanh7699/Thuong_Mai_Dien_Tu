@extends('layouts.admin')

@section('title')
    <title>Quản lý đơn hàng</title>
@endsection

@section('js')
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Order','key' =>'View'])
    <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-uppercase bg-cyan">
                        Thông tin người mua
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tên</th>
                                <th scope="col">Số điện thoại</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->phone}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-uppercase bg-cyan">
                        Thông tin vận chuyển
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Người nhận</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$shipping->name}}</td>
                                <td>{{$shipping->address}}</td>
                                <td>{{$shipping->phone}}</td>
                                <td>{{$shipping->email}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-uppercase bg-cyan">
                        Chi tiết đơn hàng - Tổng: {{number_format($order->order_total,0,',','.')}} VNĐ
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Tổng tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_details as $order_detail)
                                <tr>
                                    <td>{{$order_detail->product_name}}</td>
                                    <td>{{$order_detail->product_sales_quantity}}</td>
                                    <td>{{number_format($order_detail->product_price,0,',','.')}} VNĐ</td>
                                    <td>{{number_format($order_detail->product_sales_quantity*$order_detail->product_price,0,',','.')}} VNĐ</td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
