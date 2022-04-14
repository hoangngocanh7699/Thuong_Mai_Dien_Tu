@extends('layouts.admin')

@section('title')
    <title>Sửa User</title>
@endsection

@section('css')
    <link href="{{asset('vendors\select2\select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/user/add.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/main.css')}}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{asset('vendors\select2\select2.min.js')}}"></script>
    <script src="{{asset('admins/user/add.js')}}"></script>
@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'User','key' =>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('users.update',['id'=>$user->id])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên User</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Nhập Tên" name="name" value="{{$user->name}}">
                                @error('name')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Nhập Email" name="email" value="{{$user->email   }}">
                                @error('email')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Nhập Password" name="password" value="{{old('password')}}">
                                @error('password')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Vai Trò</label>
                                <select name="role_id[]" class="form-control select2_init" multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option
                                            {{$roleOfUser->contains('id',$role->id) ? 'selected':''}}
                                            value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
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
