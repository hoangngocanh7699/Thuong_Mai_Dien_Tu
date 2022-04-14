@extends('layouts.admin')

@section('title')
    <title>Add Setting</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/setting/add/add.css')}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Setting','key' =>'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{route('setting.store').'?type='.request()->type}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Config Key</label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror"
                                       placeholder="Nhập Config Key" name="config_key">
                                @error('config_key')
                                <div class="alert alert-danger-custom">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(request()->type ==="Text")
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <input type="text" class="form-control @error('config_value') is-invalid @enderror"
                                           placeholder="Nhập Config Value"
                                           name="config_value">
                                    @error('config_value')
                                    <div class="alert alert-danger-custom">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type ==="Textarea")
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <textarea name="config_value" rows="5" class="form-control"></textarea>
                                </div>
                            @endif
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
