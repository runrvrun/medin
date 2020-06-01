<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>MedIn | {{ $item->title }}</title>
	<meta name="description" content="MedIn">
	<meta name="keywords" content="video commercial">
	<link rel="shortcut icon" href="{{ asset('/') }}/favicon.ico">
	<link rel="stylesheet" type="text/css" href="{{ asset('startuply') }}/css/custom-animations.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('startuply') }}/css/lib/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('startuply') }}/css/flexslider.css?v=3" />
	<link rel="stylesheet" type="text/css" href="{{ asset('startuply') }}/css/style.css?v=3" />

	<!--[if lt IE 9]>
		<script src="{{ asset('startuply') }}/js/html5shiv.js"></script>
		<script src="{{ asset('startuply') }}/js/respond.min.js"></script>
	<![endif]-->
	<style>
	h2.content-title{
		margin-top:70px;
		font-size: 27px;
	}
	.navigation-bar > li:not(.featured) > a{
		color: #0F418B !important;
	}
	img.content-image{
		display: block;
		margin-left: auto;
		margin-right: auto;
		max-height: 400px;
	}
	.content-content{
		margin: 50px;
	}
	</style>
</head>

<body id="landing-page" class="landing-page">
	<!-- Preloader -->
	<div class="preloader-mask">
		<div class="preloader"><div class="spin base_clr_brd"><div class="clip left"><div class="circle"></div></div><div class="gap"><div class="circle"></div></div><div class="clip right"><div class="circle"></div></div></div></div>
	</div>

	<header>
		<nav class="navigation navigation-header">
			<div class="container">
				<div class="navigation-brand">
					<div class="brand-logo">
						<a href="{{url('/')}}" class="logo"></a>
					</div>
				</div>
				<button class="navigation-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navigation-navbar collapsed">
					<ul class="navigation-bar navigation-bar-left">
						<li><a href="/">Home</a></li>						
					</ul>
					<ul class="navigation-bar navigation-bar-right">
						<li><a href="{{ url('login') }}">Login</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="container">		
		<h2 class="content-title">{!! $item->title !!}</h2>
		<div class="flexslider">
			<ul class="slides">
				@php
				$slides = [];	
				$slides = json_decode($item->images);					
				@endphp
				@if($slides)
				@foreach($slides as $val)
				<li>
				<img class="content-image" src="{{ asset($val) }}" />
				</li>
				@endforeach
				@endif
			</ul>
		</div>
		<div class="content-content">
		{!! $item->content !!}
		</div>
	</div>

	<footer id="footer" class="footer light-text">
		<div class="container">
			<div class="footer-content row">
				<div class="col-sm-4 col-xs-12">
					<div class="logo-wrapper">
						<img height="31" src="{{ asset('images') }}/medin-white.png" alt="logo" /> <span style="font-size: 25px;vertical-align: bottom;margin-left: 4px;"></span>
					</div>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco. Qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Nisi ut aliquid ex ea commodi consequatur?</p>
					<p><strong>John Doeson, Founder</strong>.</p>
				</div>
				<div class="col-sm-5 social-wrap col-xs-12">
					
				</div>
				<div class="col-sm-3 col-xs-12">
					<strong class="heading">Our Contacts</strong>
					<ul class="list-unstyled">
						<li><span class="icon icon-chat-messages-14"></span><a href="mailto:info@medin.id">info@medin.id</a></li>
						<li><span class="icon icon-seo-icons-34"></span>2901 Marmora road, Glassgow, Seattle, WA 98122-1090</li>
						<li><span class="icon icon-seo-icons-17"></span>1 - 234-456-7980</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="copyright">MedIn 2020. All rights reserved.</div>
	</footer>

	<div class="back-to-top"><i class="fa fa-angle-up fa-3x"></i></div>

	<!--[if lt IE 9]>
		<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery-1.11.3.min.js?ver=1"></script>
	<![endif]-->
	<!--[if (gte IE 9) | (!IE)]><!-->
		<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery-2.1.4.min.js?ver=1"></script>
	<!--<![endif]-->

	<script type="text/javascript" src="{{ asset('startuply') }}/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery.appear.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery.plugin.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery.countdown.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery.mb.YTPlayer.min.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/jquery-ui-slider.min.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/toastr.min.js"></script>
	<script type="text/javascript" src="{{ asset('startuply') }}/js/startuply.js?v=1"></script>
	<script type="text/javascript">
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide"
		});
	});
	</script>
</body>
</html>