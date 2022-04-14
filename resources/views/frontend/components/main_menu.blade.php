<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{route('home')}}" class="active">Home</a></li>
        @foreach($categoryLimits as $categoryParent)
            <li class="dropdown">
                <a href="">{{$categoryParent->name}}
                    @if($categoryParent->categoryChildren->count())
                        <i class="fa fa-angle-down"></i>
                    @endif
                </a>
                @include('frontend.components.child_menu',['categoryParent'=>$categoryParent])
            </li>
        @endforeach
    </ul>
</div>
