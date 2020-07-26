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
						<li><a href="{{ url('/') }}#hero">Home</a></li>
						<li><a href="{{ url('/') }}#about">About</a></li>
						<li><a href="{{ url('/') }}#feature">Features</a></li>
						<li><a href="{{ url('/') }}#pricing">Prices</a></li>
						<li><a href="{{ url('/') }}#feedback">Feedback</a></li>
						<li><a href="{{ url('/') }}#process">Process</a></li>
						<li><a href="{{ url('/') }}#contact">Contact</a></li>
						<li id="menu-item-4742" class="dropdown"><a title="EXTRA" class="dropdown-toggle" href="#">Extra <span class="caret"></span></a>
							<ul role="menu" class=" dropdown-menu" style="display: none;">
								<li id="menu-item-4743" ><a href="http://vislog.id/" target="_blank">Vislog</a></li>																					
								<li id="menu-item-4743" ><a href="https://bitplay.id/" target="_blank">Bitplay</a></li>																					
								<li id="menu-item-4743" ><a href="http://hitek.co.id/" target="_blank">Hitek</a></li>																					
								<li id="menu-item-4743" ><a href="http://csigroup.co.id/" target="_blank">CSI</a></li>																					
							</ul>
							</li>
					</ul>
					<ul class="navigation-bar navigation-bar-right">
						<li><a href="{{ url('login') }}">Login</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="container blog" style="margin-top:50px">
		<div class="col-md-9 col-lg-8 post-list">

			<article class="post">
				<span class="post-date base-clr-bg">
					<span class="post-day">{!! $item->created_at->format('d') !!}</span>
					<span class="post-month">{!! $item->created_at->format('M') !!}</span>
					<span class="post-year">{!! $item->created_at->format('Y') !!}</span>
				</span>

				<div class="post-content">
					<h3 class="post-title highlight">{!! $item->title !!}</h3>

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
					<div class="post-text">
						{!! $item->content !!}
					</div>
				</div>
			</article>
		</div>


		<div class="sidebar col-md-3 col-lg-4">
			<div class="blog-widget blog-recent-posts">
				<h6>NEWS</h6>

				<ul class="recent-posts-list">
					@foreach($news as $new)
					<li class="recent-posts-item">
						<span class="recent-posts-item-image"><img src="{{ asset($new->featured_image) }}" alt=""></span>

						<div class="recent-posts-item-info">
							<a href="#" class="recent-posts-item-title">{{ $new->title }}</a>
							<span class="recent-posts-item-date">{{ $new->created_at->format('d M Y') }}</span>
						</div>
					</li>
					@endforeach
				</ul>
				<a href="{{ url('/news') }}" class="btn more">More News</a>
			</div>

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