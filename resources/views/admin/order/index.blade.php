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
    @include('partial.content-header',['name'=>'Order','key' =>'List'])
    <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="input-group p-2 col-md-11">
                                <div class="form-outline col-md-4">
                                    <input type="search" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Tìm kiếm"/>
                                </div>
                            </div>


{{--                                <a href=""--}}
{{--                                   class="btn btn-outline-success m-2 float-right">Add</a>--}}

                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên người đặt</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>{{optional($order->customer)->name}}</td>
                                    <td>{{number_format($order->order_total,0,',','.')}} VNĐ</td>
                                    <td>{{$order->updated_at}}</td>
                                    <td id="order_status">{{$order->order_status}}</td>

                                    <td>
                                            <a href="{{route('order.view',['id'=>$order->id])}}"
                                               class="btn btn-default">View</a>
                                        @if($order->order_status == 'Đang chờ xử lý')
                                            <a
                                                data-url="{{route('order.checked_status',['id'=>$order->id])}}"
                                               class="btn btn-outline-success  action_checked_status_order">Hoàn thành</a>
                                            @else
                                            <button type="button" class="btn btn-outline-success" disabled>Đã xong</button>
                                        @endif
                                    </td>
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
