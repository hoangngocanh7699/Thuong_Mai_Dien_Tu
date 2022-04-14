@extends('layouts.admin')

@section('title')
    <title>Thêm Permission</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/main.css')}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Permission','key' =>'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('permissions.store')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Chọn tên modul</label>
                                    <select class="form-control @error('modul_parent') is-invalid @enderror"
                                            name="modul_parent">
                                        <option value="">Chọn modul cha</option>
                                        @foreach(config('permissions.table_modul') as $modulItem)
                                            <option value="{{$modulItem}}">{{$modulItem}}</option>
                                        @endforeach
                                    </select>
                                    @error('modul_parent')
                                    <div class="alert alert-danger-custom">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="row">
                                    @foreach(config('permissions.modul_childrent') as $modulItemChildrent)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input checkbox_children" type="checkbox"
                                                       value="{{$modulItemChildrent}}" name="modul_childrent[]">
                                                <label class="form-check-label text-info font-weight-bold">
                                                    {{$modulItemChildrent}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
