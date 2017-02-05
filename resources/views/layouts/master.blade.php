<!DOCTYPE html>
<html lang="ru">
    <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>

	<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/css/owl.theme.default.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;subset=cyrillic" rel="stylesheet">

	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/media.css">

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style type="text/css">
	    html {
		overflow: hidden;
	    }

	    .main-header {
		padding-top: 80px;
	    }

	    .main-header:before {
		top: 200px;
	    }
	</style>
	
	<script>
	    window.Laravel = <?php
		echo json_encode([
		    'csrfToken' => csrf_token(),
		]);
	    ?>
	</script>

    </head> 
    <body id="app">
	<header class="main-header">
	    <div class="header__logo-wrap">
		
		<a class="header__logo_link" href="{{ url('/') }}">
		    <img src="/images/logo.png" alt="logo" width="166" height="73">
		</a>
		
	    </div>

	    <div class="header__menu-wrap">
		<ul class="header__menu-lists">
		    <li class="header__menu_list">
			<a class="menu__list_link" href="media-list.html">Media</a>
		    </li>
		    <li class="header__menu_list">
			<a class="menu__list_link" href="contact.html">Contact</a>
		    </li>
		</ul>
	    </div>

	    <div class="main-header__other_wrap">
		<ul class="main-header__lists">
		    @foreach($categories as $cat)
		    <li class="header__list">
			@if(in_array(Request::path(), ['en','ru']))
			<a href="#" class="header__list_link" v-on:click.prevent="getOptions({{$cat->id}})">{{$cat->title}}</a>
			@else
			<a href="/" class="header__list_link">{{$cat->title}}</a>
			@endif
		    </li>
		    @endforeach
		</ul>
		<div class="main-header__cart">
		    <div class="main-header__log_wrap">
			@if (Auth::guest())
			<a href="{{ url('/login') }}" class="header__log_text">Log in</a>
			@else
			<a href="{{ url('/logout') }}" class="header__log_text"
			   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
			    Logout
			</a>

			<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
			    {{ csrf_field() }}
			</form>
			@endif
		    </div>
		    @include('includes.language')
		    <div class="main-header__cart_wrap">
			<p class="header__cart_number">$150</p>
			<a class="header__cart_icon" href="cart.html"></a>
			<span class="header__cart_count">1</span>
		    </div>
		</div>
	    </div>
	</header>

	@yield('content')

	<footer class="main-footer">
	    <div class="footer__content">
		<ul class="footer__content_map">
		    <li class="footer__map_list">
			<a href="{{ url('/register') }}" class="footer__map_link">Create account</a>
		    </li>
		    <li class="footer__map_list">
			<a href="shipping.html" class="footer__map_link">Shipping</a>
		    </li>
		    <li class="footer__map_list">
			<a href="contact.html" class="footer__map_link">Contact</a>
		    </li>
		</ul>

		<div class="footer__content_sign">
		    <h3 class="footer__sign_tittle">Stay Up To Date</h3>
		    <p class="footer__sign_text">Sign up to get the latest news, giveaways, exclusive coupons + more:</p>
		    <form class="footer__sign_form" method="post">
			<input class="footer__form_input" type="text" name="email" placeholder="Your Email Address">
			<input class="footer__form_btn" type="submit" value="Sign up">
		    </form>
		</div>

		<ul class="footer__content_social">
		    <li class="footer__social_unit">
			<a class="footer__social_link icon_g" href="#0"></a>
		    </li>
		    <li class="footer__social_unit">
			<a class="footer__social_link icon_fb" href="#0"></a>
		    </li>
		    <li class="footer__social_unit">
			<a class="footer__social_link icon_youtube" href="#0"></a>
		    </li>
		    <li class="footer__social_unit">
			<a class="footer__social_link icon_insta" href="#0"></a>
		    </li>
		</ul>

		<div class="footer__content_copyright">
		    <p class="footer__copyright_text">&copy;2016-2017 INEED&reg;, a registered trademark of INEED Co. 
			All rights reserved</p>
		</div>
	    </div>
	</footer>

	<script src="/libs/jquery/dist/jquery.min.js" type="text/javascript"></script>
	<script src="/libs/owl.carousel.min.js" type="text/javascript"></script>
	<script src="/js/common.js" type="text/javascript"></script>
	@if(in_array(Request::path(), ['en','ru']))
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.1.2/vue-resource.min.js"></script>
	<script src="/js/filter.js" type="text/javascript"></script>
	@endif

    </body>
</html>