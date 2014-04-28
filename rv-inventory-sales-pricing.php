<?php 

	include('includes/title.inc.php'); 
	$dealership = 'Both';
	require_once('includes/connection.inc.php');
    
    $conn = dbConnect('write');
                
    $sql = "SELECT 
            vrvInventory.stockNum,
            vrvInventory.year, 
            vrvInventory.make, 
            vrvInventory.model, 
            vrvInventory.model_num, 
            vrvInventory.msrp, 
            vrvInventory.no_hassle, 
            vrvInventory.specials,
            vrvInventory.special_price,
            vrvInventory.type, 
            vrvInventory.dealmaker, 
            vrvInventory.location, 
            vrvInventory.unit_condition, 
            vrvInventory.ext_color, 
            vrvInventory.status, 
            vrvInventory.visibility
        FROM vrvInventory 
        WHERE  visibility = 'Show' AND vrvInventory.location = 'North' AND vrvInventory.unit_condition = 'New'
        ORDER BY vrvInventory.make, vrvInventory.model, vrvInventory.model_num, vrvInventory.stockNum";
        
    // submit the query and capture the result
    
    $result = $conn->query($sql) or die(mysqli_error($conn));

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
	<link href="css/print.css" media="print" rel="stylesheet" type="text/css" />
	
	<script src="bower_components/gumby/js/libs/modernizr-2.6.2.min.js"></script>
	<script src="js/respond.min.js"></script>

</head>

<body>

	<?php include_once('analyticstracking.php'); ?>

	<?php include('includes/main-nav.php'); ?>

	<div class="full-width page-head color-secondary-orange-dk-2">
		<div class="row">
			<div class="twelve columns">
					<h3>New Unit Pricing</h3>
			</div>
		</div>
	</div>
	
	<div class="full-width">
        <div class="row">
		    <div class="twelve columns missing-inv">
		    
		    	<table class="striped">
		    		<thead>
		    			<tr>
		    				<td>Stock</td>
		    				<td>Year</td>
		    				<td>Make</td>
		    				<td>Model</td>
		    				<td>Model Num</td>
		    				<td>MSRP</td>
		    				<td>No Hassle</td>
		    				<td>Dealmaker</td>
		    				<td>Special Pricing</td>
		    				<td>Status</td>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			
		    			<?php 
		    				while ($row = $result->fetch_assoc()) { 
		    					
		    					$imgdir = "unit-img/" . $row['stockNum'] . "/";
								$unit_imgs = glob($imgdir."*.jpg");
    
			    			 	if ($row['status'] <> 'Sold') {
		    			?>
		    			
		    			<tr>
		    				<td><?php echo $row['stockNum']; ?></td>
		    				<td><?php echo $row['year']; ?></td>
		    				<td><?php echo $row['make']; ?></td>
		    				<td><?php echo $row['model']; ?></td>
		    				<td><?php echo $row['model_num']; ?></td>
		    				
		    				<td><?php echo money_format('%.0n', $row['msrp']); ?></td>
		    				<td><?php echo money_format('%.0n', $row['no_hassle']); ?></td>
							<td><?php echo money_format('%.0n', $row['dealmaker']); ?></td>
							<?php if($row['special_price']) { ?>
							<td style="color: red;"><?php echo money_format('%.0n', $row['special_price']); ?></td>
							<?php } else { ?>
								<td>N/A</td>
							<?php } ?> 
		    				<td><?php echo $row['status']; ?></td>
		    			</tr>
		    			
		    			<?php 
		    					}
	    					}
    					?>
		    			
		    		</tbody>
		    	</table>
		        		                
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
