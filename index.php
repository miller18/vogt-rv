<?php 

require_once('includes/connection.inc.php');

$conn = dbConnect('write');

$errors = array();
$missing = array();

if (isset($_POST['signup'])) {
    // Email processing script
    
    include('includes/nuke_magic_quotes.php'); 
    $to = 'mahlon.miller@mac.com'; 
    $subject = 'Newsletter Subscribe';
    $expected = array('email');
    $required = array('email');
        
    // create additional headers
    $headers = "From: Email Subscription <vogtrv@vogtrv.com>\r\n";
    $headers .=  'Content-Type: text/pain; charset=utf-8';
    
    require('includes/processmail.inc.php');
    
    if ($mailsent) {
        // inserts data into table
        
        $ok = false;
        // create database connection
                // initialize prepared statement
        $stmt = $conn->stmt_init();
        // create sql
        $sql = 'INSERT INTO vrvCustomers (email_address, source, opt_in, date) VALUES (?, ?, ?, NOW())'; 
        if ($stmt->prepare($sql)) {
            $source = 'email sign up';
            $opt_in = 'Yes';
            // bind parameters and execute statement 
            $stmt->bind_param('sss', $email, $source, $opt_in);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $ok = true;
            }
        }
    }
}


if (isset($_POST['send'])) {
    // Email processing script
    
    include('includes/nuke_magic_quotes.php'); 
    $to = 'mahlon.miller@mac.com';
    $subject = 'Company Contact';
    $expected = array('first_name', 'last_name', 'email', 'comments', 'subscribe');
    $required = array('first_name', 'last_name', 'email', 'comments', 'subscribe');
    //set default values for variables that may not exist
    if (!isset($_POST['subscribe'])) {
        $_POST['subscribe'] = ' ';
    }
    
    // create additional headers
    $headers = "From: Vogt RV's Company Contact<vogtrv@vogtrv.com>\r\n";
    $headers .=  'Content-Type: text/pain; charset=utf-8';
    
    require('includes/processmail.inc.php');
    
    if ($mailsent) {
        // inserts data into table
        require_once('includes/connection.inc.php');
        
        $ok = false;
        // create database connection
        $conn = dbConnect('write');
        // initialize prepared statement
        $stmt = $conn->stmt_init();
        // create sql
        $sql = 'INSERT INTO vrvCustomers (first_name, last_name, email_address, source, opt_in, date) VALUES (?, ?, ?, ?, ?, NOW())'; 
        if ($stmt->prepare($sql)) {
            $source = 'homepage inquiry';
            // bind parameters and execute statement 
            $stmt->bind_param('sssss', $first_name, $last_name, $email, $source, $subscribe);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $ok = true;
            }
        }
    }
}

    $dealership = 'Main';

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

    <title>Vogt RV Centers | Motorhomes | Travel Trailers | Fifth Wheels | RV Service | RV Parts | Fort Worth, TX</title>
	<meta name="description" content="Welcome to Vogt Country, your one stop shop for all of the top RV brands in the industry.  Jayco, Tiffin, Allegro, Leisure Travel, Airstream, Croassroads, and more.  We also offer high quality RV service and parts. 35 years in the RV business.">

	<meta name="author" content="humans.txt">

	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
	
	<meta name="google-site-verification" content="G3PWEmBtYdBtHrMDIUdiCDg_tuCdS5PZ7HpY0RgL6JM" />
	
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

	<div class="modal" id="north-map">
		<div class="content">
			<a class="close switch" gumby-trigger="|#north-map"><i class="icon-cancel"></i></a>
			<div class="row">
				<div class="twelve columns centered">
					<h4>Vogt Family Fun Center</h4>
					<p>5301 Airport Freeway - Fort Worth, TX 76117 - 817.831.1800</p>
					<div class="row">
						<div class="nine columns">
							<img src="img/dealer-map-north.jpg" alt="dealer-map-north">
						</div>
						<div class="three columns hours">
		                    <ul>
		                    	<li>Hours</li>
		                    	<li>Monday - Friday</li>
		                    	<li>9 AM to 5:30 PM</li>
		                    	<li>Saturday</li>
		                    	<li>9 AM to 5 PM</li>
		                    	<li>Closed Sunday</li>
		                    </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="south-map">
		<div class="content">
			<a class="close switch" gumby-trigger="|#south-map"><i class="icon-cancel"></i></a>
			<div class="row">
				<div class="twelve columns centered">
					<h4>Vogt Motorhome Center</h4>
					<p>5624 Airport Freeway - Fort Worth, TX 76117 - 817.831.4222</p>
					<div class="row">
						<div class="nine columns">
							<img src="img/dealer-map-south.jpg" alt="dealer-map-south" >
						</div>
						<div class="three columns hours">
		                    <ul>
		                    	<li>Hours</li>
		                    	<li>Monday - Friday</li>
		                    	<li>9 AM to 5:30 PM</li>
		                    	<li>Saturday</li>
		                    	<li>9 AM to 5 PM</li>
		                    	<li>Closed Sunday</li>
		                    </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="logo-header">
		<div class="row">
			
				<img src="img/logo-with-flag.png">
			<h3>
				Welcome to Vogt Country's World of RVs
			</h3>
		</div>
	</div>
	
	<?php include('includes/main-nav.php'); ?>
	
	<div class="row">
		<div class="three columns sidebar">
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
			<div class="row">
				<div class="location">
					<h5>Vogt Motorhome Center</h5>
                    <p>
                        <a href="#"><img src="img/dealer-map-north.jpg" class="dealer-map"></a><br />
                       <p class="blue-btn"> <a href="#" class="switch" gumby-trigger="#south-map">View Map and Hours</a></p>
                    </p>
                    <p>
                        5624 Airport Freeway<br />
                        Fort Worth, TX 76117<br />
                        817.831.4222
                    </p>
				</div>
			</div>
			<div class="row">
				<div class="location">
					<h5>Vogt RV's Family Fun Center</h5>
                    <p>
                        <a href="#"><img src="img/dealer-map-north.jpg" class="dealer-map"></a><br />
                       <p class="blue-btn"> <a href="#" class="switch" gumby-trigger="#north-map">View Map and Hours</a></p>
                    </p>
                    <p>
                        5301 Airport Freeway<br />
                        Fort Worth, TX 76117<br />
                        817.831.1800
                    </p>
				</div>
			</div>
		</div>
		<div class="nine columns">

			<?php include('includes/icon-nav.php'); ?>
			
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
							<div><img src="img/tiffin-motorhomes-rotation.jpg" alt="Tiffin Motorhomes"></div>
							<figcaption>
								<h4>Texas Best Tiffin Motorhome Dealer</h4>
								<a class="small-btn" href="rv-inventory-listing.php?make=Tiffin&unit_condition=New">See the 2014 Tiffins</a>
								
							</figcaption>
						</figure>
					</li>
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
				<div class="twelve columns newsletter">
					<div class="news-form">
					        <form method="post" action="index.php">
						        <?php if (isset($_POST['signup'])) { ?>
						            <?php if ($missing && in_array('email', $missing)) { ?> 
			                            <small class="danger alert">Please enter your email address</small>
			                        <?php } elseif (isset($errors['email'])) { ?>
			                            <small class="danger alert">Please enter a valid email address</small>
			                        <?php } elseif ($mailsent)  { ?>
			                            <span class="success alert">Thank you, look for special offers and early savings from Vogt RV.</span>
			                        <?php } ?>
		                         <?php } ?>
					            <div class="email-form-wrapper">
		                            <input class="newsletter-subscribe" type="email" id="newsletter-subscribe" name="email" placeholder="Join our email club - Learn about early sales and exclusive specials!">
		                            <button name="signup" id="signup" type="submit" ><i class="icon-thumbs-up icon-large"></i></button>
					            </div>
		                    </form>
						</div>
				</div>
			</div>
			<div class="row">
				<h3 class="color-secondary-yellow-lt text-centered rounded">Featured Inventory</h3>
			</div>
			<?php include('includes/featured-units.php'); ?>
			<div class="row about-us hide-for-small">
				<h4>Welcome to Vogt Country</h4>
			    <p>Vogt RV is your North Texas full service RV Dealer! The Vogt family has been serving recreational enthusiasts of North Texas for over forty years and offers a vast array of new RVs from light weight travel trailers and tent campers to full time fifth wheels to luxury diesel pushers.  At Vogt RV you will appreciate the quality of our employees and our selection of RVs from America's finest makers of recreational vehicles.  We are a family owned and operated dealership, which offers something for everyone regardless o your budget.  Come to Vogt RV and discover the wonderful world of the RV lifestyle through the quality and value of our product.</p>

                <p>Vogt RV has been recognized as a A+ rating with the Better Business Bureau.  We continue to aim to give our customers the best service in the industry.  Our customers are important to us and we consider you to be a part of the Vogt family.  We value the importance of repeat and referral business. </p>
                
                <p>Vogt RV is one of the top 100 privately owned companies in Tarrant County and Vogt RV has been one of the Texas leading motorhome dealers for over thirty years.  Our huge list of manufacturers is like a who's who in RV design, comfort, safety, and quality.  Come by and see the beautiful models by Jayco, Tiffin, Airstream, Crossroads, Coachmen, and Skyline.</p>
                
                <p>Vogt RV, your Dallas and Fort Worth Texas RV Dealer is located just four miles east of downtown Fort Worth on highway 121 between Haltom Road and Carson Street on both the North and South side of Airport Freeway (Highway 121).</p>
                
                <p>Don't forget to visit our Facebook page for specials on accessories parts and service.  Or if you like, follow us on Twitter!<p>
                
                <p>And remember the 2013 model year is coming to a close.  At Vogt RV we are getting new 2014 motorhomes, travel trailers and fifth wheels daily.  So take your pick and save thousands on a 2013 closeout...or see the newest 2014 coaches and the new innovations they have to offer.</p>
                
                <p>At Vogt RV, the Texas tradition...you can be sure you are going to get great service, great products and Texas sized savings!  Remember the place to be for your RV needs is V O G T R V.</p>
                
                <p>"The best brand names at the lowest prices with full service where customer satisfaction is priority #1!"</p>
			</div>
			<div class="row contact-us">
				<h3>We Want To Hear From You!</h3>
                        
                        <?php if (isset($_POST['send'])) { ?>
                        
	                        <?php if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
	                        
	                            <p class="danger alert">Sorry, your message could not be sent at this time.</p>
	                        
	                        <?php } elseif (($missing || $errors) && isset($_POST['send'])) { ?>
	                        
	                            <p class="danger alert">Please fix the item(s) indicated.</p>
	                            
	                        <?php } elseif ($mailsent)  { ?>
	                        
	                            <p class="success alert">Thank you for your inquiry, we will contact you shortly.</p>
	                            
	                        <?php } ?>  

                        <?php } ?> 
                        
				<section class="tabs pill">

				    <ul class="tab-nav">
				        <li class="active"><a href="#">Contact our Company</a></li>
				        <li> <a href="#">Vogt Motorhomes</a></li>
				        <li><a href="#">Family Fun Center</a></li>
				    </ul>
				
					<!-- Tab One -->
				    <div class="tab-content active">
				        <form class="company-contact" method="post" action="index.php">
				        	<ul>
								<li class="field <?php if ($missing && in_array('first_name', $missing)) { ?> danger <?php } ?>">
									<input class="normal text input" type="text" name="first_name"  placeholder="First Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['first_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
									<input class="normal text input" type="text" name="last_name"  placeholder="Last Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['last_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</li>
								<li class="field <?php if ($missing && in_array('email', $missing) && isset($_POST['send'])) { ?> danger <?php } ?>">
									<input class="email input" type="email" name="email"  placeholder="jane@smithco.com" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>								
								</li>
								<li class="field">
									<label class="radio checked" for="subscribe-yes">
										<input name="subscribe" type="radio" id="subscribe-yes" value="Yes" <?php if(!$_POST || $_POST['subscribe'] == 'Yes') { echo 'checked'; } ?>>
										<span></span>  Yes, Please keep me informed about your sales and events.
									</label>
									<label class="radio" for="subscribe-no">
								    	<input name="subscribe" type="radio" id="subscribe-no" value="No" <?php if ($_POST && $_POST['subscribe'] == 'No') { echo 'checked'; } ?>> 
										<span></span> No thank you.
									</label>								
								</li>
								<li class="field <?php if ($missing && in_array('comments', $missing)) { ?> danger <?php } ?>">
									<textarea class="input textarea" name="comments" ><?php if ($missing || $errors) { echo htmlentities($_POST['comments'], ENT_COMPAT, 'UTF-8') ; } ?>                                            </textarea>
								</li>
								<li>
								 	<button class="blue-btn" name="send" id="send" type="submit" >Send Message</button>
								</li>
							</ul>
						</form>
				    </div>
				    <!-- End of Tab One -->
				    
				    <!-- Tab Two -->
				    <div class="tab-content salespeople">
				        <h4>Vogt Motorhomes</h4>
				        <?php include('includes/homepage-staff-contact-south.php'); ?>
				    </div>
				    <!-- End of Tab Two-->
				    
				    <!-- Tab Three -->
				    <div class="tab-content salespeople">
				        <h4>Vogt Family Fun Center</h4>
				        <?php include('includes/homepage-staff-contact-north.php'); ?>
				    </div>
				    <!-- End of Tab Three -->
				
				</section>
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
