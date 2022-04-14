@extends('layouts.admin')

@section('title')
    <title>Sửa Role</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/role/add/add.css')}}">
@endsection

@section('js')
    <script src="{{asset('admins/role/add/add.js')}}"></script>
@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Role','key' =>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('roles.update',['id'=>$role->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Tên Vai Trò</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Nhập Tên Vai Trò" name="name" value="{{$role->name}}">
                                    @error('name')
                                    <div class="alert alert-danger-custom">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Mô Tả Vai Trò</label>

                                    <textarea name="display_name"
                                              class="form-control @error('display_name') is-invalid @enderror"
                                              rows="4">{{$role->display_name}}</textarea>
                                    @error('display_name')
                                    <div class="alert alert-danger-custom">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 m-lg-2  {{$i = 0}}">
                                <div class="row">
                                    <div class="form-check">
                                        <input class="checkall" type="checkbox">
                                        <label class="form-check-label font-weight-bold">
                                            Check All
                                        </label>
                                    </div>

                                    @foreach($permissionParent as $permissionParentItem)

                                        <div class="card col-md-12">
                                            <div
                                                class="card-header  {{   $i %2==0 ?'bg-success':'bg-warning' }} ">
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox_wrapper" type="checkbox">
                                                    <label class="form-check-label font-weight-bold  {{$i = $i+1}}">
                                                        Modul {{$permissionParentItem->display_name}}
                                                    </label>
                                                </div>

                                            </div>

                                            <div class="row">
                                                @foreach($permissionParentItem->permissionChildren as $permissionChildrenItem)
                                                    <div class="card-body col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input checkbox_children"
                                                                   type="checkbox"
                                                                   name="permission_id[]"
                                                                   value="{{$permissionChildrenItem->id}}"
                                                                {{$permissionChecked->contains('id',$permissionChildrenItem->id)?'checked':''}}
                                                            >
                                                            <label class="form-check-label text-info ">
                                                                {{$permissionChildrenItem->display_name}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
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
