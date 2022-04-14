<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach($categorys as $category)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$category->id}}">
                                <span class="badge pull-right">
                                    @if($category->categoryChildren->count() > 0)
                                        <i class="fa fa-plus"></i>
                                    @endif
                                </span>
                                {{$category->name}}
                            </a>
                        </h4>
                    </div>
                    <div id="{{$category->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category->categoryChildren as $categoryChildren)
                                    <li>
                                        <a href="{{route('category.product',['slug'=>$categoryChildren->slug,'id'=>$categoryChildren->id])}}">{{$categoryChildren->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!--/category-products-->


{{--        <div class="shipping text-center"><!--shipping-->--}}
{{--            <img src="{{asset('eshopper/images/home/sidebar_right.png')}}" alt=""/>--}}
{{--        </div><!--/shipping-->--}}

    </div>
</div>
