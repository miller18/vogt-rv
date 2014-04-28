<?php 

	include('includes/title.inc.php'); 
	$dealership = 'Both';
		
?>

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en" itemscope="" itemtype="http://schema.org/Product"> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<!-- Use the .htaccess and remove these lines to avoid edge case issues.
			 More info: h5bp.com/b/378 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Vogt RV<?php if (isset($title)) { echo "&#8212;{$title}"; } ?></title>
	
	<meta name="author" content="humans.txt">

	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">

	<!-- Facebook Metadata /-->
	<meta property="fb:page_id" content="">
	<meta property="og:image" content="">
	<meta property="og:description" content="">
	<meta property="og:title" content="">

	<!-- Google+ Metadata /-->
	<meta itemprop="name" content="">
	<meta itemprop="description" content="">
	<meta itemprop="image" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

	<!-- We highly recommend you use SASS and write your custom styles in sass/_custom.scss.
		 However, there is a blank style.css in the css directory should you prefer -->
	<link rel="stylesheet" href="css/gumby.css">
	<!-- <link rel="stylesheet" href="css/style.css"> -->
	<!-- bxSlider CSS file -->
	<link href="css/jquery.bxslider.css" rel="stylesheet" />

	<script src="bower_components/gumby/js/libs/modernizr-2.6.2.min.js"></script>
	<script src="js/respond.min.js"></script>

</head>

<body>

	<?php include_once('analyticstracking.php'); ?>

	<?php include('includes/main-nav.php'); ?>

	<div class="full-width page-head color-secondary-orange-dk-2">
		<div class="row">
				<div class="twelve columns">
					<h3>RV Brochure Library</h3>
				</div>
			</div>
		</div>
		
		<div class="full-width">
	   		<div class="row">
	        	<div class="twelve columns page-content">
	        		<ul>
	                 	<li>Tiffin</li>
	                 	<li><a href="rv-brochures/2014-allegro.pdf">2014 Tiffin Allegro</a></li>
	                 	<li><a href="rv-brochures/2014-allegro-specs.pdf">2014 Tiffin Allegro Specs</a></li>
	                 	<li><a href="rv-brochures/2014-allegro-breeze.pdf">2014 Tiffin Allegro Breeze</a></li>
	                 	<li><a href="rv-brochures/2014-allegro-breeze-specs.pdf">2014 Tiffin Allegro Breeze Specs</a></li>
	                 	<li><a href="rv-brochures/2014-allegro-red.pdf">2014 Tiffin Allegro RED</a></li>
	                 	<li><a href="rv-brochures/2014-allegro-red-specs.pdf">2014 Tiffin Allegro RED Specs</a></li>
	                 	<li><a href="rv-brochures/2014-phaeton.pdf">2014 Tiffin Phaeton</a></li>
	                 	<li><a href="rv-brochures/2014-phaeton-specs.pdf">2014 Tiffin Phaeton Specs</a></li>
	                 	<li><a href="rv-brochures/2014-allegro-bus.pdf">2014 Tiffin Allegro Bus</a></li>
	                 	<li><a href="rv-brochures/2014-allegro-bus-specs.pdf">2014 Tiffin Allegro Bus Specs</a></li>
	                 	<li><a href="rv-brochures/2013-zephyr.pdf">2014 Tiffin Zephyr</a></li>
	                 	<li><a href="rv-brochures/2013-zephyr-specs.pdf">2014 Tiffin Zephyr Specs</a></li>
	                 </ul>
	                 
	                  <ul>
	                 	<li>Jayco</li>
	                 	<li><a href="#">2014 Jayco Jay Series</a></li>
	                 	<li><a href="#">2014 Jayco Jay Series Sport</a></li>
	                 	<li><a href="#">2014 Jayco Baja</a></li>
	                 	<li><a href="#">2014 Jayco Jay Feather</a></li>
	                 	<li><a href="rv-brochures/2014-White-Hawk.pdf">2014 Jayco White Hawk</a></li>
	                 	<li><a href="rv-brochures/2014-Jay-Flight-Swift-SLX.pdf">2014 Jayco Jay Flight Swift SLX</a></li>
	                 	<li><a href="rv-brochures/2014-Jay-Flight-Swift-SLX.pdf">2014 Jayco Jay Flight Swift</a></li>
	                 	<li><a href="rv-brochures/2014-Jay-Flight.pdf">2014 Jayco Jay Flight</a></li>
	                 	<li><a href="#">2014 Jayco Jay Flight DST</a></li>
	                 	<li><a href="rv-brochures/2014-Eagle-HT.pdf">2014 Jayco Eagle HT</a></li>
	                 	<li><a href="#">2014 Jayco Eagle</a></li>
	                 	<li><a href="rv-brochures/2014-Eagle-Premier.pdf">2014 Jayco Eagle Premier</a></li>
	                 	<li><a href="rv-brochures/2014-Pinnacle.pdf">2014 Jayco Pinnacle</a></li>
	                 	<li><a href="#">2014 Jayco Redhawk</a></li>
	                 	<li><a href="#">2014 Jayco Greyhawk</a></li>
	                 	<li><a href="rv-brochures/2014-Melbourne.pdf">2014 Jayco Melbourne</a></li>
	                 	<li><a href="#">2014 Jayco Seneca</a></li>
	                 	<li><a href="rv-brochures/2014-Precept-Class-A.pdf">2014 Jayco Precept</a></li>
	                 	<li><a href="rv-brochures/2014-Octane.pdf">2014 Jayco Octane ZX</a></li>
	                 	<li><a href="#">2014 Jayco Seismic</a></li>
	                 </ul>
	                 
	                 <ul>
	                 	<li>Leisure Travel</li>
	                 	<li><a href="rv-brochures/2014-Free-Spirit.pdf">2014 Free Spirit</a></li>
	                 	<li><a href="rv-brochures/2014-Serenity-Libero.pdf">2014 Serenity</a></li>
	                 	<li><a href="rv-brochures/2014-Unity.pdf">2014 Unity</a></li>
	                 </ul>
	     
	                 <ul>
	                 	<li>Cruiser RV</li>
	                 	<li><a href="rv-brochures/2014-fun-finder.pdf">2014 Cruiser RV Fun Finder</a></li>
	                 	<li><a href="rv-brochures/2014-fun-finder-xtra.pdf">2014 Cruiser RV Fun Finder XTRA</a></li>
	                 	<li><a href="rv-brochures/2014-shadow-cruiser.pdf">2014 Cruiser RV Shadow Cruiser</a></li>
	                 	<li><a href="rv-brochures/2014-viewfinder.pdf">2014 Cruiser RV Viewfinder</a></li>
	                 	<li><a href="rv-brochures/2014-radiance.pdf">2014 Cruiser RV Radiance</a></li>
	                 	<li><a href="rv-brochures/2014-enterra.pdf">2014 Cruiser RV Enterra</a></li>
	                 </ul>
	                 
	                 <!--
	                  <ul>
	                 	<li>Crossroads RV</li>
	                 	<li><a href="rv-brochures/2014-rushmore.pdf">2014 Crossroads RV Rushmore</a></li>
	                 	<li><a href="rv-brochures/2014-cruiser.pdf">2014 Crossroads RV Cruiser</a></li>
	                 	<li><a href="rv-brochures/2014-cruiser-aire.pdf">2014 Crossroads RV CruiserAire</a></li>
	                 	<li><a href="rv-brochures/2014-cruiser-patriot.pdf">2014 Crossroads RV Cruiser Patriot</a></li>
	                 	<li><a href="rv-brochures/2014-sunset-trail-reserve.pdf">2014 Crossroads RV Sunset Trail Reseve</a></li>
	                 	<li><a href="rv-brochures/2014-sunset-trail-lite.pdf">2014 Crossroads RV Sunset Trail Lite</a></li>
	                 </ul>
	                 -->
	                 
	                  <ul>
	                 	<li>Dutchmen</li>
	                 	<!--<li><a href="rv-brochures/2014-dutchmen.pdf">2014 Dutchmen</a></li>-->
	                 	<li><a href="rv-brochures/2014-aerolite.pdf">2014 Dutchmen Aerolite</a></li>
	                 	<!--<li><a href="rv-brochures/2014-infinity.pdf">2014 Infinity</a></li>-->
	                 </ul>
	                 
	                  <ul>
	                 	<li>Airstream</li>
	                 	<li><a href="rv-brochures/2013-Airstream-travel-trailers.pdf">2013 Airstream Travel Trailers</a></li>
	                 	<li><a href="rv-brochures/2013-Airstream-motorhomes.pdf">2013 Airstream Motor Coaches</a></li>
	                 </ul>
				</div>
			</div>
		</div>
					    
	
	<?php include('includes/main-footer.php'); ?>

	<!-- Grab Google CDN's jQuery, fall back to local if offline -->
	<!-- 2.0 for modern browsers, 1.10 for .oldie -->
	<script>
	var oldieCheck = Boolean(document.getElementsByTagName('html')[0].className.match(/\soldie\s/g));
	if(!oldieCheck) {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"><\/script>');
	} else {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"><\/script>');
	}
	</script>
	<script>
	if(!window.jQuery) {
	if(!oldieCheck) {
	  document.write('<script src="bower_components/gumby/js/libs/jquery-2.0.2.min.js"><\/script>');
	} else {
	  document.write('<script src="bower_components/gumby/js/libs/jquery-1.10.1.min.js"><\/script>');
	}
	}
	</script>

	<!--
	Include gumby.js followed by UI modules followed by gumby.init.js
	Or concatenate and minify into a single file -->
	<script gumby-touch="js/libs" src="bower_components/gumby/js/libs/gumby.js"></script>
	<script src="bower_components/gumby/js/libs/ui/gumby.retina.js"></script>
	<script src="bower_components/gumby/js/libs/ui/gumby.fixed.js"></script>
	<script src="bower_components/gumby-fittext/gumby.fittext.js"></script>
	<script src="bower_components/gumby/js/libs/ui/gumby.skiplink.js"></script>
	<script src="bower_components/gumby/js/libs/ui/gumby.toggleswitch.js"></script>
	<script src="bower_components/gumby/js/libs/ui/gumby.checkbox.js"></script>
	<script src="bower_components/gumby/js/libs/ui/gumby.radiobtn.js"></script>
	<script src="bower_components/gumby/js/libs/ui/gumby.tabs.js"></script>
	<script src="bower_components/gumby/js/libs/ui/gumby.navbar.js"></script>
	<script src="bower_components/gumby/js/libs/ui/jquery.validation.js"></script>
	<script src="bower_components/gumby/js/libs/gumby.init.js"></script>
	<script src="js/jquery.bxslider.min.js"></script>
	<script>
		$(document).ready(function(){
		  $('.bxslider').bxSlider({
		  		mode: 'fade',
		  		captions: true,
		  		auto: true,
		  		autoControls: true
		  	});
		});
	</script>

	<!--
	Google's recommended deferred loading of JS
	gumby.min.js contains gumby.js, all UI modules and gumby.init.js

	Note: If you opt to use this method of defered loading,
	ensure that any javascript essential to the initial
	display of the page is included separately in a normal
	script tag.

	<script type="text/javascript">
	function downloadJSAtOnload() {
	var element = document.createElement("script");
	element.src = "js/libs/gumby.min.js";
	document.body.appendChild(element);
	}
	if (window.addEventListener)
	window.addEventListener("load", downloadJSAtOnload, false);
	else if (window.attachEvent)
	window.attachEvent("onload", downloadJSAtOnload);
	else window.onload = downloadJSAtOnload;
	</script> -->

	<script src="bower_components/gumby/js/plugins.js"></script>
	<script src="bower_components/gumby/js/main.js"></script>

	<!-- Change UA-XXXXX-X to be your site's ID -->
	<!--<script>
	window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
	Modernizr.load({
	  load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
	});
	</script>-->

	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	   chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

  </body>
</html>
