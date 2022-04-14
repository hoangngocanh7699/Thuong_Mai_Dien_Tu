@extends('layouts.admin')

@section('title')
    <title>Danh sách Slider</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/slider/add/add.css')}}">
@endsection

@section('js')
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Slider','key' =>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="input-group p-2 col-md-11">
                                <div class="form-outline col-md-4">
                                    <input type="search" id="myInput" onkeyup="myFunction()" class="form-control"
                                           placeholder="Tìm kiếm"/>
                                </div>
                            </div>
                            @can('slider-add')
                                <a href="{{route('slider.create')}}"
                                   class="btn btn-outline-success m-2 float-right">Add</a>
                            @endcan
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Mô Tả</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->description}}</td>
                                    <td><img src="{{$value->image_path}}" class="product_image_150_150"></td>
                                    <td>
                                        @can('slider-edit')
                                            <a href="{{route('slider.edit',['id'=>$value->id])}}"
                                               class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('slider-delete')
                                            <a href=""
                                               data-url="{{route('slider.delete',['id'=>$value->id])}}"
                                               class="btn btn-outline-danger action_delete">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            <td>
                                {{$data->links()}}
                            </td>

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
