@extends('layouts.admin')

@section('title')
    <title>Danh sách User</title>
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
    @include('partial.content-header',['name'=>'User','key' =>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('user-add')
                            <a href="{{route('users.create')}}" class="btn btn-outline-success m-2 float-right">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Loại người dùng</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>
                                        @if(!$value->roles->isEmpty())
                                        @foreach($value->roles as $role)
                                            <span>{{$role->name}}</span> |
                                        @endforeach
                                            @endif
                                    </td>

                                    <td>
                                        @can('user-edit')
                                            <a href="{{route('users.edit',['id'=>$value->id])}}"
                                               class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('user-delete')
                                            <a href=""
                                               data-url="{{route('users.delete',['id'=>$value->id])}}"
                                               class="btn btn-outline-danger action_delete">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            <td>
                                {{$users->links()}}
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
