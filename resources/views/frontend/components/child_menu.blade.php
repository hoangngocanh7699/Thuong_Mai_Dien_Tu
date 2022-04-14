@if($categoryParent->categoryChildren->count())
        <ul role="menu" class="sub-menu">
            @foreach($categoryParent->categoryChildren as $categoryChildren)
                <li class="{{$categoryChildren->categoryChildren->count() ?'dropdown':''}}"><a href="{{route('category.product',['slug'=>$categoryChildren->slug,'id'=>$categoryChildren->id])}}">{{$categoryChildren->name}}</a>
                    @if($categoryChildren->categoryChildren->count())
                        @include('frontend.components.child_menu',['categoryParent'=>$categoryChildren])
                    @endif
                </li>
            @endforeach
        </ul>
@endif
