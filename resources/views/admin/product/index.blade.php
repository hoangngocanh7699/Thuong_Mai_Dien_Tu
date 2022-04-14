@extends('layouts.admin')

@section('title')
    <title>Sản phẩm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins\product\index\list.css')}}">
@endsection

@section('js')
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
    <script>
        $(function () {
            $(document).on('keyup', '#myInputSearch', function () {
                var keyword = $(this).val();
                $.ajax({
                    type: "get",
                    url: $(this).data('url'),
                    data: {keyword: keyword},
                    dataType: "json",
                    success: function (response) {
                        $('#search-result').html(response);
                    }
                });
            });
        });
    </script>
@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Product','key' =>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="input-group p-2 col-md-11">
                                <div class="form-outline col-md-6 position-relative">
                                                                        <input type="search" id="myInput" onkeyup="myFunction()" class="form-control"
                                                                               placeholder="Tìm kiếm"/>
{{--                                    <input data-url="{{route('product.searchbar')}}" type="search" id="myInputSearch" class="form-control"--}}
{{--                                           placeholder="Tìm kiếm"/>--}}
{{--                                    <div id="search-result" class="position-absolute list-group bg-white wrapper-full-page rounded-t-none shadow-lg"></div>--}}
                                </div>
                            </div>
                            @can('product-add')
                                <a href="{{route('product.create')}}"
                                   class="btn btn-outline-success m-2 float-right">Add</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @foreach($product as $value)
                            <tr>
                                <th scope="row">{{$value->id}}</th>
                                <th scope="row">{{$value->name}}</th>
                                <th scope="row">{{number_format($value->price,0,',','.')}}</th>
                                <th scope="row"><img style="height: 80px;width: 80px"
                                                     src="{{$value->feature_image_path}}" alt=""></th>
                                <th scope="row">{{optional($value->category)->name}}</th>
                                <td>

                                    <a href="{{route('product.edit',['id'=> $value->id])}}"
                                       class="btn btn-default">Edit</a>

                                    @can('product-delete')
                                        <a href=""
                                           data-url="{{route('product.delete',['id'=>$value->id])}}"
                                           class="btn btn-outline-danger action_delete">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        <td>
                            {{$product->links()}}
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
