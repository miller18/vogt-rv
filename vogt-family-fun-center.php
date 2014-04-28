<?php

	include('includes/title.inc.php'); 
    require_once('includes/connection.inc.php');
    
    $pos = 0;
    $firstrow = true;
    define('SHOWMAX', 4);
    $conn = dbConnect('write');
   
    $getTotal = 'SELECT COUNT(*) FROM vrvInventory';
    
    // submit query and store result as $totalInv
    
    $total = $conn->query($getTotal);
    $rows = $total->fetch_row();
    $totalInv = $rows[0];
    
    // set the currnet page
    
    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 0;
    
    $startrow = $curPage * SHOWMAX;
    
    $sql = "SELECT stockNum, year, make, model, model_num,  msrp, sale, dealmaker, type, unit_condition, status, int_color, ext_color FROM vrvInventory WHERE featured = 'Yes' AND location = 'South' LIMIT $startrow, " . SHOWMAX;
    
    // submit the query and capture the result
    
    $result = $conn->query($sql) or die(mysqli_error($conn));
    
    $dealership = 'North';

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
	
	<div class="logo-header">
		<div class="row">
			
			<img src="img/logo-with-flag.png">
			<h3>
				Vogt Family Fun Center
			</h3>
		</div>
	</div>
	
	<?php include('includes/main-nav.php'); ?>
	
	<div class="row">
		<div class="three columns sidebar location-side">
			<div class="row">
			
				<?php include('includes/main-side-nav.php'); ?>
				
			</div>
			
			<div class="row hide-for-small">
				<p class="bbb-block"><a href="http://www.bbb.org/fort-worth/business-reviews/recreational-vehicles-dealers/vogt-rv-center-in-fort-worth-tx-92040086/#bbbonlineclick" target="_blank"><img src="http://seal-fortworth.bbb.org/seals/blue-seal-63-134-vogt-rv-center-92040086.png" alt="VOGT RV CENTER BBB Business Review" /></a>Vogt RV has been recognized as an A+ rating with the Better Business Bureau. We continue to aim to give our customers the best service in the industry. We value our customers and do the best we can to give our customers the best experience possible when they visit us. Thank you!</p>
			</div>
			<div class="row hide-for-small">
				<div class="success-block"><a href="//www.toyoursuccess.com/reviews/popup:3786" target="_blank"><img class="to-your-success" src="//www.toyoursuccess.com/static/widget/badge1-blue.png" ></a>
				</div>
			</div>
		</div>
		<div class="nine columns">
			
			<div class="row img-rotation hide-for-small">
				<ul class="bxslider">
					<!--
					<li>
						<figure class="rv-show">
							<div><img src="img/show-continues.jpg" alt="The Fort Worth RV Show"></div>
							<figcaption>
								<div class="row">
									<div class="nine columns">
										<h5 class="white-text">Our Incredible Show Pricing Will Continue</h5>
										<p class="white-text">through Saturday, January 18th</p>
									</div>
									<div class="three columns">
										<a class="blue-btn" href="rv-inventory-rv-show.php">GET OUR SHOW PRICES</a>
									</div>
								</div>
							</figcaption>
						</figure>
					</li>
					-->
					<li>
						<figure>
							<div><img src="img/spring-cleaning-sale-2.jpg" alt="Spring Value Sale"></div>
							<!-- <figcaption>
								<h4>Spring is almost here - Get A New RV and Save Big</h4>
								<a class="small-btn" href="/rv-inventory-special-sale.php">Our Spring Specials</a>
							</figcaption> -->
						</figure>
					</li>					
					<?php include('includes/deal-of-the-month.php'); ?>
					<li>
						<figure>
							<div><img src="img/airstream-2014.jpg" alt="Airstream Travel Trailers"></div>
							<figcaption>
								<h4>The 2014 Airstreams are here</h4>
								<a class="small-btn" href="rv-inventory-listing.php?make=Airstream&location=North&unit_condition=New">More Information</a>
							</figcaption>
						</figure>
					</li>
				</ul>
			</div>
			
			<div class="row">
				<h3 class="color-secondary-yellow-lt text-centered rounded">Spring Specials</h3>
			</div>
			
			<?php include('includes/featured-units.php'); ?>
			
			<?php include('includes/dealership-testimonials.php'); ?>
			
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
		  		autoControls: true,
		  		adaptiveHeight: true
		  		
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
