<div class="main-header__language_wrap">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
	@if($localeCode != LaravelLocalization::getCurrentLocale())
	<a class="header__language_text" rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
	    {{$localeCode}}
	</a>
	@endif
    @endforeach
</div>