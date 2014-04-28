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
					<h3>Get the RV parts you need</h3>
					<h2>With Vogt RV's Parts Department</h2>
				</div>
			</div>
		</div>
		
		<div class="full-width page-head color-secondary-yellow-lt-2">
			<div class="row">
				<h5>Vogt Parts Department - 5624 Airport Freeway - Fort Worth, TX 76117 - 817.831.4222</h5>
			</div>
		</div>
		
		<div class="full-width">
	   		<div class="row">
	        	<div class="twelve columns page-content">
	        		<section>
			        	<p>If you're not familiar with Vogt RV, Our Family has been in the recreational business since 1945 in the Fort Worth, Texas area. Over the last 10 years, we have sold more New Motorhomes in Texas than any other Dealership. We have two Stores in the DFW area. We have decided to use this concept to bring you great deals on RV Parts, Supplies and Accessories. Also a Bonus Marine Parts and Accessories Catalog</p>
						<p>Our desire is to earn your business and we are NOW offering our online customers easy access to two of the largest RV Parts Distributors Catalogs in the country. What makes this unique is it gives YOU the opportunity to browse both RV catalogs and a Marine catalog, compare prices and purchase at the best possible price available.</p>
						
					</section>
				</div>
			</div>
	    
			<div class="row">
				<div class="eight columns">
					<p>We can keep our prices low because you order directly from these Distributors. They handle the payment, packaging and ship directly to you, so you know you will be getting the newest stock and not something that's been sitting around on a dealers shelf for months or years. So, have fun shopping.</p>
					<p>Throughout these catalogs you will find parts from the leading manufactures of RV and Marine Parts and appliances, including Coleman, Dometic, Norcold, Carefree, A&E, Valterra, Duo-Therm, SeaLand, Thedford, Aqua-Magic, Porti-Potti, Maxx Air, FanTastic, Shurflo, Onan and many others. Shop for all types and brands of RV parts supplies & accessories. </p>
				</div>
				<div class="four columns">
					<ul class="parts-nav">
						<li><a class="orange-btn" href="https://www.ntpdistribution.com/Via/index.jsp?RefAgent=R0022895" target="_blank">NTP Parts Distribution</a></li>
						<li><a class="orange-btn" href="http://www.go-rv.com/coast/do/catalog/main?dealerId=2718" target="_blank">Coast Distribution</a></li>
						<li><a class="orange-btn" href="http://www.go-marine.com/coast/do/catalog/main?dealerId=2718" target="_blank">Coast Marine Distribution</a></li>
						<li><a class="orange-btn" href="http://www.bonanzle.com/booths/VogtCountry?item_sort_options%5Bfilter_category_id%5D=&amp;item_sort_options%5Bcustom_category_id%5D=&amp;item_sort_options%5Bcustom_category_name%5D=&amp;item_sort_options%5Bbonanza_only%5D=&amp;item_sort_options%5Bfilter_string%5D=&amp;item_sort_options%5Bsort_by%5D" target="_blank">Liquidation Parts</a></li>
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
