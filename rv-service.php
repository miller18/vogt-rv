<?php 

	include('includes/title.inc.php'); 
	require_once('includes/connection.inc.php');
	$dealership = 'Both';

	$conn = dbConnect('write');
	
	$errors = array();
	$missing = array();
	
	if (isset($_POST['send'])) {
	    // Email processing script
	    
	    include('includes/nuke_magic_quotes.php'); 
	    $to = 'service@vogt.com';
	    $subject = 'Service Request';
	    $expected = array('first_name', 'last_name', 'email', 'phone', 'street_address', 'city', 'state', 'zip_code', 'unit',  'drop_off_date', 'drop_off_time', 'comments', 'subscribe');
	    $required = array('first_name', 'last_name', 'email', 'phone', 'unit',  'drop_off_date', 'drop_off_time', 'comments', 'subscribe');
	    //set default values for variables that may not exist
	    if (!isset($_POST['subscribe'])) {
	        $_POST['subscribe'] = ' ';
	    }
	    
	    // create additional headers
	     $headers = "From: Service Request <vogtrv@vogtrv.com>\r\n";
	    
		 require('includes/processmail_tbl.inc.php');
	    
	    if ($mailsent) {
	        // inserts data into table
	        require_once('includes/connection.inc.php');
	        
	        $ok = false;
	        // create database connection
	        $conn = dbConnect('write');
	        // initialize prepared statement
	        $stmt = $conn->stmt_init();
	        // create sql
	        $sql = 'INSERT INTO vrvCustomers (first_name, last_name, email_address, phone, zip_code, source, opt_in, date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())'; 
	        if ($stmt->prepare($sql)) {
	            $source = 'service request';
	            // bind parameters and execute statement 
	            $stmt->bind_param('sssssss', $first_name, $last_name, $email, $phone, $zip_code, $source, $subscribe);
	            $stmt->execute();
	            if ($stmt->affected_rows > 0) {
	                $ok = true;
	            }
	        }
	    }
	}
	
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
					<h3>Get back on the road</h3>
					<h2>With Vogt RV's Service Department</h2>
				</div>
			</div>
		</div>
		
		<div class="full-width page-head color-secondary-yellow-lt-2">
			<div class="row">
				<h5>Vogt Service Department - 5624 Airport Freeway - Fort Worth, TX 76117 - 817.831.4222</h5>
			</div>
		</div>
		
		<div class="full-width">
	   		<div class="row page-content">
				<div class="six columns">
					<section>
			        	<p>Vogt RV Service Department in Forth Worth Texas has the experience, training, knowledge, and resources to keep your wheels rolling.  From small towables, large motor coaches, hitch work, tow bar installations, appliances, and accessory installations, we offer a comprehensive list of services to keep you focused on what is important...YOUR RECREATION!</p>
						<p>Give us a call at 817.831.4222 to schedule your appointment or set up an appointment online!</p>
					</section>
					<section>
						<h5>Why  choose Vogt RV for your RV service needs?</h5>
						<ul>
							<li>Over 50 Years combined RV service experience!</li>
							<li>Certified and Master Certified technicians on duty!</li>
							<li>Many repairs done while you wait!</li>
							<li>We specialize in insurance repairs!</li>
							<li>We specialize in storm damage repairs!</li>
							<li>We work with most extended service policies!</li>
							<li>We do warranty repairs for many manufacturers!</li>
							<li>We do hitch installations!</li>
						</ul>
					</section>
				</div>
				<div class="six columns">
					<form class="service-contact color-secondary-yellow-lt-2" method="post" action="rv-service.php">
						<h4>Schedule Your Service</h4>
						<?php if (isset($_POST['send'])) { ?>
                        
	                        <?php if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
	                        
	                            <p class="danger alert">Sorry, your message could not be sent at this time.</p>
	                        
	                        <?php } elseif (($missing || $errors) && isset($_POST['send'])) { ?>
	                        
	                            <p class="danger alert">Please fix the item(s) indicated.</p>
	                            
	                        <?php } elseif ($mailsent)  { ?>
	                        
	                            <p class="success alert">Thank you for your inquiry, we will contact you shortly.</p>
	                            
	                        <?php } ?>  

                        <?php } ?> 
						<ul>
	             			<li>
								<div class="field <?php if ($missing && in_array('first_name', $missing)) { ?> danger <?php } ?> one-half">
									<input class=" text input" type="text" name="first_name" id="first_name" placeholder="Your first name..." <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['first_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
								<div class="field  <?php if ($missing && in_array('last_name', $missing)) { ?> danger <?php } ?> one-half">
									<input class=" text input"  type="text" name="last_name" id="last_name" placeholder="Your last name..." <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['last_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
							</li>
							<li>
								<div class="field <?php if ($missing && in_array('email', $missing)) { ?> danger <?php } ?> one-half">
				                    <input class="input" type="email" name="email" id="email" placeholder="Email address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
								<div class="field <?php if ($missing && in_array('phone', $missing)) { ?> danger <?php } ?> one-half">
				                    <input class="input" type="phone" name="phone" id="phone" placeholder="Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['phone'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
							</li>
							<li class="field">
		                    	<input class="input" type="text" name="street_address" id="street_address" placeholder="Street Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['street_address'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
							</li>
							<li>
								<div class="field one-half">
		                    		<input class="input" type="text" name="city" id="city" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['city'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
								<div class="field one-fourth">
		                    		<input class="input" type="text" name="state" id="state" placeholder="State" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['state'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
								<div class="field one-fourth">
		                    		<input class="input" type="text" name="zip_code" id="zip_code" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['zip_code'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
							</li>
							<li class="field <?php if ($missing && in_array('unit', $missing)) { ?> danger <?php } ?>">
		                    	<input class="input" type="text" name="unit" id="unit" placeholder="Your Unit" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['unit'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
							</li>
							<li>
								<div class="field <?php if ($missing && in_array('drop_off_date', $missing)) { ?> danger <?php } ?> one-half">
		                    		<input class="input" type="text" name="drop_off_date" id="drop_off_date" placeholder="Drop Off Date" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['drop_off_date'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
								<div class="field <?php if ($missing && in_array('drop_off_time', $missing)) { ?> danger <?php } ?> one-half">
		                    	<input class="input" type="text" name="drop_off_time" id="drop_off_time" placeholder="Drop Off Time" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['drop_off_time'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
								</div>
							</li>
							<li>Describe your service issues:</li>
							<li class="field <?php if ($missing && in_array('comments', $missing)) { ?> danger <?php } ?>">
								    <textarea class="input textarea" id="comments" name="comments">

                                <?php if ($missing || $errors) { echo htmlentities($_POST['comments'], ENT_COMPAT, 'UTF-8') ; } ?></textarea>
							</li>
							<li class="field">
								<label class="radio checked" for="subscribe-yes">
									<input name="subscribe" type="radio" id="subscribe-yes" value="Yes" <?php if(!$_POST || $_POST['subscribe'] == 'Yes') { echo 'checked'; } ?>>
									<span></span> Yes, Please keep me informed about your sales and events.
								</label>
								<label class="radio" for="subscribe-no">
									<input name="subscribe" type="radio" id="subscribe-no" value="No" <?php if ($_POST && $_POST['subscribe'] == 'No') { echo 'checked'; } ?>>
									<span></span> No thank you.
								</label>
							</li>
							<li class="field text-centered">
		                		<input class="blue-btn" name="send" id="send" type="submit" value="Send Message" />
							</li>
	             		</ul>
					</form>
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
