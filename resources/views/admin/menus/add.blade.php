@extends('layouts.admin')

@section('title')
    <title>Thêm Menu</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/main.css')}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Menu','key' =>'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{route('menus.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên Menu</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Nhập Tên Menu" name="name">
                                @error('name')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>
                            <label>Nhập Tên Menu Cha</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">Chọn Menu cha</option>
                                {!! $selectOption !!}
                            </select>
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
