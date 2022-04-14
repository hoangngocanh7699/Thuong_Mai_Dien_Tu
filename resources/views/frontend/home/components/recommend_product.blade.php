<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">sản phẩm nổi bật</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            @foreach($productsRecommend as $keyRecommendItem => $productsRecommendItem)
                @if($keyRecommendItem % 3 == 0)
                    <div class="item {{$keyRecommendItem == 0 ?'active':''}}">
                @endif
                        <div class="col-sm-4">
                            <div class="product-image-wrapper" style="height: 400px">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img
                                            src="{{config('app.base_url').$productsRecommendItem->feature_image_path}}" style="width: 170px;height: 170px"/>
                                        <h2>{{number_format($productsRecommendItem->price,0,',','.')}} VNĐ</h2>
                                        <p>{{$productsRecommendItem->name}}</p>
                                        <a data-url="{{route('product.addToCart',['id'=>$productsRecommendItem->id])}}" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="{{route('product.detailsProduct',['id'=>$productsRecommendItem->id])}}"><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                @if($keyRecommendItem % 3 == 2)
                    </div>
                @endif
            @endforeach

        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel"
           data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel"
           data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
