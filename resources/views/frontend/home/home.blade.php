@extends('frontend.layouts.master')

@section('title')
    <title> E-Shopper</title>
@endsection

@section('css')
    <link href="{{asset('home-frontend/home.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('home-frontend/home.js')}}"></script>
@endsection

@section('content')

    <!--/slider-->
    @include('frontend.home.components.slider')
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.components.sidebar')
                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                @include('frontend.home.components.feature_product')
                    <!--features_items-->

                    <!--/category-tab-->
                @include('frontend.home.components.category_tab')
                    <!--/category-tab-->

                    <!--/recommended_items-->
                @include('frontend.home.components.recommend_product')
                    <!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>

@endsection





