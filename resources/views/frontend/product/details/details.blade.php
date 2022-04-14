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

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.components.sidebar')
                <div class="col-sm-9 padding-right">

                    <div class="product-details"><!--product-details-->
                        <h2 class="title text-center">Chi tiết sản phẩm</h2>
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{$product->feature_image_path}}" style="width: 327px;height: 305px"/>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    @if(isset($product) && count($product->images) > 0)
                                        @php $count = 0; @endphp
                                        <div class="item active">
                                            @foreach($product->images as $image)
                                                <img src="{{asset($image->image_path)}}" style="width: 84px;height: 84px">
                                                @php $count = $count + 1; @endphp
                                                @if($count % 3 == 0) </div><div class="item">@endif
                                            @endforeach
                                        </div>
                                    @endif

                                </div>

                                <!-- Controls -->
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="{{asset('eshopper/images/product-details/new.jpg')}}" class="newarrival"
                                     alt=""/>
                                <h2>{{$product->name}}</h2>

                                <span>
									<span>Giá: {{number_format($product->price,0,',','.')}} VNĐ</span>
									<label></label>
                                <a data-url="{{route('product.addToCart',['id'=>$product->id])}}"
                                class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

								</span>
                                <p><b>Loại:</b> {{$product->category->name}}</p>
                                <p><b>Tags:</b> @foreach($product->tags as $tag) #{{$tag->name}}   @endforeach</p>

                            </div><!--/product-information-->
                        </div>

                        <div class="col-sm-12">
                            <p>{!!$product->content!!}</p>
                        </div>

                    </div><!--/product-details-->

                </div>
            </div>
        </div>
    </section>

@endsection





