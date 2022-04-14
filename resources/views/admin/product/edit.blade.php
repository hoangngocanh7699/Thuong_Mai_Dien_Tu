@extends('layouts.admin')

@section('title')
    <title>Thêm sản phẩm</title>
@endsection

@section('css')
    <link href="{{asset('vendors\select2\select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins\product\add\add.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/main.css')}}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{asset('vendors\select2\select2.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    {{--    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}
    <script src="{{asset('admins\product\add\add.js')}}"></script>

@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Product','key' =>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <form action="{{route('product.update',['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập Tên Sản Phẩm" name="name"
                                       value="{{$product->name}}">
                                @error('name')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Giá Sản Phẩm</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Nhập Giá Sản Phẩm" name="price"
                                       value="{{$product->price}}">
                                @error('price')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" class="form-control-file" name="feature_image_path">
                                <div class="col-md-4 container_image_detail">
                                    <div class="row">
                                        <img class="image_detail_product" src="{{$product->feature_image_path}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]">
                                <div class="col-md-12 container_image_detail">
                                    <div class="row">
                                        @foreach($product->images as $value)
                                            <div class="col-md-3">
                                                <img class="image_detail_product" src="{{$value->image_path}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tag_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tag)
                                        <option value="{{$tag->name}}" selected>{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nhập nội dung</label>
                                <textarea name="contents" class="form-control tinymce_editor_init @error('contents') is-invalid @enderror"
                                          rows="25">{{$product->content}}</textarea>
                                @error('contents')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 mb-4">Submit</button>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </form>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
