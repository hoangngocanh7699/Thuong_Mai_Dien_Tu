@php
$baseurl = config('app.base_url');
@endphp

<section id="slider" style="height: 370px"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        @foreach($sliders as $key => $slider)
                            <div class="item {{$key==0 ? 'active':''}}">
                                <div class="col-sm-4">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>{{$slider->name}}</h2>
                                    <p>{{$slider->description}}</p>
                                </div>
                                <div class="col-sm-8">
                                    <img src="{{$baseurl.$slider->image_path}}" class="girl img-responsive" alt=""/>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
