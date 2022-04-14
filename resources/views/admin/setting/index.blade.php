@extends('layouts.admin')

@section('title')
    <title>Setting</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/setting/index/index.css')}}">
@endsection

@section('js')
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
@endsection



@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Setting','key' =>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="input-group p-2 col-md-10">
                                <div class="form-outline col-md-4">
                                    <input type="search" id="myInput" onkeyup="myFunction()" class="form-control"
                                           placeholder="Tìm kiếm"/>
                                </div>
                            </div>
                            <div class="btn-group float-right">
                                @can('setting-add')
                                    <a class="btn dropdown-toggle btn btn-outline-success" data-toggle="dropdown"
                                       href="">
                                        Add
                                        <span class="caret"></span>
                                    </a>
                                @endcan
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('setting.create').'?type=Text'}}">Text</a></li>
                                    <li><a href="{{route('setting.create').'?type=Textarea'}}">Text Area</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Config Key</th>
                                <th scope="col">Config Value</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody id="myTable">

                            @foreach($setting as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->config_key}}</td>
                                    <td>{{$value->config_value}}</td>
                                    <td>
                                        @can('setting-edit')
                                            <a href="{{route('setting.edit',['id'=>$value->id]).'?type='.$value->type}}"
                                               class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('setting-delete')
                                            <a href="" class="btn btn-outline-danger action_delete"
                                               data-url="{{route('setting.delete',['id'=>$value->id])}}">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            <td>
                                {{$setting->links()}}
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
