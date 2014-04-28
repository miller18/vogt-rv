	<?php 
	
	include('includes/title.inc.php');
	
	$errors = array();
	$missing = array();
	$ok = false;
	require_once('includes/connection.inc.php');
	$conn = dbConnect('write');
	
	if (isset($_POST['submit'])) {
	    // Email processing script
	    
	    include('includes/nuke_magic_quotes.php'); 
	    $to = $_POST['manager_email'];
	    $subject = 'Spring Cleaning Price - Stock Number: ' . $_GET['stocknum'];
	    $expected = array('stock_number', 'year', 'make', 'model', 'model_number', 'show_price', 'first_name', 'last_name', 'email', 'phone', 'zip_code', 'subscribe');
	    $required = array('first_name', 'last_name', 'email', 'subscribe');
	    //set default values for variables that may not exist
	    if (!isset($_POST['subscribe'])) {
	        $_POST['subscribe'] = ' ';
	    }
	    
	    // create additional headers
	    $headers = "From: Spring Cleaning Sale<vogtrv@vogtrv.com>\r\n";
	    
	    require('includes/processmail_tbl.inc.php');
	    
	    if ($mailsent) {
	       
   	        // initialize prepared statement
	        $stmt = $conn->stmt_init();
	        // create sql
	        $sql = 'INSERT INTO vrvCustomers (first_name, last_name, email_address, phone, zip_code, source, opt_in, date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())'; 
	        if ($stmt->prepare($sql)) {
	            $source = 'spring cleaning sale';
	            // bind parameters and execute statement 
	            $stmt->bind_param('sssssss', $first_name, $last_name, $email, $phone, $zip_code, $source, $subscribe);
	            $stmt->execute();
	            if ($stmt->affected_rows > 0) {
	                $ok = true;
	            }
	        }
	    }
	}
	
	$stocknumber = $_GET['stocknum'];
	$sql_unit = "
        
        SELECT 
            year, 
            make, 
            model, 
            model_num, 
            msrp, 
            show_price,
            type, 
            location, 
            unit_condition
		FROM vrvInventory 
		WHERE (vrvInventory.stockNum = '$stocknumber')";
    
    $result = $conn->query($sql_unit) or die(mysqli_error($conn));		
    $unit = $result->fetch_assoc();
	
	 setlocale(LC_MONETARY, 'en_US');
	 
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

	<title>Vogt RV - Get Your Sale Price</title>
	
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

	<div class="dealmaker-header color-secondary-yellow">
		<div class="row">
			<h2><?php echo $unit['year'] . " " . $unit['make'] . " " . $unit['model'] . " " . $unit['model_num']; ?></h2>
		</div>
	</div>
	
	<div class="dealmaker-response color-secondary-orange-dk-2">
			<div class="row">
			
				
				<?php if (!$_POST) { ?>
					<h4 class="dealmaker-price white-text">Vogt RV's Spring Cleaning Sale</h4>
					<p>Don't wait, our sale prices are only available for a limited time.</p>
				<?php } elseif (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
			        <p class="round alert label">Sorry, your message could not be sent at this time.</p>
				<?php } elseif (($missing || $errors) && isset($_POST['submit'])) { ?>
					<p class="round alert label">Please fix the item(s) indicated.</p>
			    <?php } elseif ($ok)  { ?>
	    	
					 <?php
					 
						 $msrp = $unit['msrp'];
						 $show_price = $unit['show_price'];
						 
						 $no_hassle = $msrp - $show_price;
					 
					 ?>
					 
					 <?php if ($unit['location'] == 'South') { ?>
					 
					 <h5 class="dealmaker-price white-text">MSRP:  <?php echo money_format('%.0n', $msrp); ?>  </h3>
					 <h4 class="dealmaker-price white-text"> "Spring Cleaning" Discount:  <?php echo money_format('%.0n', $no_hassle); ?>  </h2> 
					 <h3 class="dealmaker-price value-sale-price">Our "Spring Cleaning" Price  <?php echo money_format('%.0n', $unit['show_price']); ?>  </h1>
					 <p>This special is available until Saturday, April 5th, 2014 and is applicable to this stock number <span class="stk-num"><?php echo $stocknumber; ?></span> and availability is very limited. </p>
					 <p>If you would like to reserve this unit, contact us, or bring this flyer in with you.</p>
					 
					 <div class="row">
						 	<h4 class="white-text">Vogt Motorhome Center</h4>
						 	<p class="dealmaker-address">
						 		5624 Airport Freeway<br>
						 		Fort Worth, TX 76117<br>
						 		817.831.4222
						 	</p>
						 	<script> 
								 if (window.print) {
									 document.write('<form class="js-print"><input class="blue-btn" type=button name=print value="Print" onClick="window.print()"></form>');
								 }
							 </script>
					 
					 </div>
					 
					 <?php } else { ?>
					 
					
					
					 <h5 class="dealmaker-price white-text">MSRP:  <?php echo money_format('%.0n', $msrp); ?>  </h3>
					 <h4 class="dealmaker-price white-text"> "Spring Cleaning" Discount:  <?php echo money_format('%.0n', $no_hassle); ?>  </h2> 
					 <h3 class="dealmaker-price value-sale-price">Our "Spring Cleaning" Price  <?php echo money_format('%.0n', $unit['show_price']); ?>  </h1>
					 <p>This special is available until Saturday, April 5th, 2014 and is applicable to this stock number <span class="stk-num"><?php echo $stocknumber; ?></span> and availability is very limited. </p>
					<p>If you would like to reserve this unit, contact us, or bring this flyer in with you.</p>
						 
					 <div class="row">
						 	<h4 class="white-text">Vogt Family Fun Center</h4>
						 	<p class="dealmaker-address">
						 		5301 Airport Freeway<br>
						 		Fort Worth, TX 76117<br>
						 		817.831.1800
						 	</p>
						 	<script> 
								 if (window.print) {
									 document.write('<form class="js-print"><input class="blue-btn" type=button name=print value="Print" onClick="window.print()"></form>');
								 }
							 </script>
					 	
					 </div>
					 
					 <?php } ?>
			 <?php }  ?>
	    
	    </div>
		</div>
		
		<?php if (!$_POST || !$ok) { ?>	
	        
	   <div id="dealmaker-form">
	   
	   		<div class="row">
	   
	        <form name="dealmaker" method="POST" action="early-show-pricing.php?stocknum=<?php echo $stocknumber; ?>">
	        
	        	<input type="hidden" name="stock_number" value="<?php echo $stocknumber; ?>">
	        	<input type="hidden" name="year" value="<?php echo $unit['year']; ?>">
	        	<input type="hidden" name="make" value="<?php echo $unit['make']; ?>">
	        	<input type="hidden" name="model" value="<?php echo $unit['model']; ?>">
	        	<input type="hidden" name="model_number" value="<?php echo $unit['model_num']; ?>">
	        	<input type="hidden" name="show_price" value="<?php echo money_format('%.0n', $unit['show_price']); ?>">
	        	
	        	<?php if ($unit['location'] == 'South') {
		        	
		        	echo '<input type="hidden" name="manager_email" value="dvogt@vogtrv.com">';
		        	
	        	} else {
		        	
		        	echo '<input type="hidden" name="manager_email" value="bmckamie@vogtrv.com">';
		        	
	        	} ?>
	        	
	            <div class="row">
             		<ul>
             			<li>
						<div class="field <?php if ($missing && in_array('first_name', $missing)) { ?> danger <?php } ?> form-name">
							<input class=" text input" type="text" name="first_name" id="first_name" placeholder="Your first name..." <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['first_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
						</div>
						<div class="field form-name <?php if ($missing && in_array('last_name', $missing)) { ?> danger <?php } ?>">
							<input class=" text input"  type="text" name="last_name" id="last_name" placeholder="Your last name..." <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['last_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
						</div>
						</li>
						<li class="field <?php if ($missing && in_array('email', $missing)) { ?> danger <?php } ?>">
		                    <input class="input" type="email" name="email" id="email" placeholder="Email address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
						</li>
						<li class="field <?php if ($missing && in_array('zip_code', $missing)) { ?> danger <?php } ?>">
	                    	<input class="input" type="text" name="zip_code" id="zip_code" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['zip_code'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
						</li>
						<li class="field">
	                    	<input class="input" type="phone" name="phone" id="phone" placeholder="Phone number">
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
	                		<input type="submit" name="submit" class="blue-btn" id="submit_btn" value="Get Your Price" />
						</li>
             		</ul>
	            </div>
	        </form>
	   		</div>
	   </div>
	        
	   <?php } ?>
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

			