<div class="features_items">
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper" style="height: 400px">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{config('app.base_url').$product->feature_image_path}}"
                             style="width: 170px;height: 170px"/>
                        <h2>{{number_format($product->price,0,',','.')}} VNĐ</h2>
                        <p>{{$product->name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{number_format($product->price)}} VNĐ</h2>
                            <p>{{$product->name}}</p>
                            <a data-url="{{route('product.addToCart',['id'=>$product->id])}}"
                               class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                    <img src="{{asset('eshopper/images/home/new.png')}}" class="new" alt=""/>
                </div>

                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="{{route('product.detailsProduct',['id'=>$product->id])}}"><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
                    </ul>
                </div>

            </div>
        </div>
    @endforeach

</div>
