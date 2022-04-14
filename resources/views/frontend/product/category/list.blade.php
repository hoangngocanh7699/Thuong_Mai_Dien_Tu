
@extends('frontend.layouts.master')

@section('title')
    <title> Trang Chủ</title>
@endsection

@section('css')
    <link href="{{asset('home-frontend/home.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('home-frontend/home.js')}}"></script>
@endsection

@section('content')

    <!--/slider-->
{{--        @include('home-frontend.components.slider')--}}
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                                @include('frontend.components.sidebar')
                                <div class="col-sm-9 padding-right">
                                    <!--features_items-->
                                @include('frontend.components.recommend_product')
                                <!--features_items-->

                                    <!--/category-tab-->
{{--                                @include('home-frontend.components.category_tab')--}}
                                <!--/category-tab-->

                                    <!--/recommended_items-->
{{--                                @include('home-frontend.components.recommend_product')--}}
                                <!--/recommended_items-->

            </div>
        </div>
        </div>
    </section>

@endsection





