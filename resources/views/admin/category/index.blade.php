@extends('layouts.admin')

@section('title')
    <title>Danh mục sản phẩm</title>
@endsection

@section('js')
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Category','key' =>'List'])
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

                        @can('category-add')
                            <a href="{{route('categories.create')}}"
                               class="btn btn-outline-success m-2 float-right">Add</a>
                        @endcan
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>

                                    <td>
                                        @can('category-edit')
                                            <a href="{{route('categories.edit',['id'=>$value->id])}}"
                                               class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('category-delete')
                                            <a href="" data-url="{{route('categories.delete',['id'=>$value->id])}}"
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
