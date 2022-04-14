@extends('layouts.admin')

@section('title')
    <title>Sửa Slider</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/slider/add/add.css')}}">
@endsection

@section('js')

@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Slider','key' =>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('slider.update',['id'=>$slider->id])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Slider</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Nhập Tên Slider" name="name" value="{{$slider->name}}">
                                @error('name')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mô Tả</label>

                                <textarea name="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          rows="4">{{$slider->description}}</textarea>
                                @error('description')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror"
                                       name="image_path">
                                <div class="col-md-4 container_image_detail">
                                    <img src="{{$slider->image_path}}" class="image_detail_product">
                                </div>
                                @error('image_path')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
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
