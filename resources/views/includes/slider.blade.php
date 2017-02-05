<div class="main-slider">
    <div class="main-slider__owl owl-carousel owl-theme">
	@foreach($slides as $slide)
	<div class="slider-owl__item">
	    <img class="slider-owl__image" src="/{{$slide->image}}" alt="{{$slide->title}}" width="1916" height="673">
	    <p class="owl__item_text">{{$slide->sub_title}}</p>
	    <h2 class="owl__item_title">{{$slide->title}}</h2>
	    @if($slide->button != '')
	    <a class="owl__item_link" href="{{$slide->link}}">{{$slide->button}}</a>
	    @endif
	</div>
	@endforeach
    </div>
</div>