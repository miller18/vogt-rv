<?php

	include('includes/title.inc.php');
	setlocale(LC_MONETARY, 'en_US');
	require_once('includes/connection.inc.php');

	$pos = 0;
    $firstrow = true;
    $dealership = 'Both';
   
    $conn = dbConnect('write');
    define('SHOWMAX', 8);
   
    $search_stmt = '';
    $search_url = '';
    $search_variables = array($_GET['location'],$_GET['unit_condition'],$_GET['type']);
    $search_conditions = array('vrvInventory.location', 'vrvInventory.unit_condition', 'vrvInventory.type');
    $search_url_tags = array('location','unit_condition','type');
    $counter = 0;
    
    foreach($search_variables as $search_variable) {
        
        if($search_variable) {
            $search_stmt .=" and $search_conditions[$counter] = '$search_variable'"; 
            $search_url .="&$search_url_tags[$counter]=$search_variable";
        } 
        
        $counter++;
        
    }
    
    $getTotal = "SELECT COUNT(*) FROM vrvInventory WHERE  visibility = 'Show' $search_stmt";
    
    // submit query and store result as $totalInv
    
    $total = $conn->query($getTotal);
    $rows = $total->fetch_row();
    $totalInv = $rows[0];
    
        
    // set the currnet page
    
    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 0;
    
    $startrow = $curPage * SHOWMAX;
	
    $sql = "SELECT 
            vrvInventory.stockNum,
            vrvInventory.year, 
            vrvInventory.make, 
            vrvInventory.model, 
            vrvInventory.model_num, 
            vrvInventory.msrp, 
            vrvInventory.sale, 
            vrvInventory.type, 
            vrvInventory.location, 
            vrvInventory.unit_condition, 
            vrvInventory.featured, 
            vrvInventory.status, 
            vrvInventory.visibility, 
            vrvInvOptions.options,
            vrvInvOptions.miles,
            vrvInvOptions.uvw,
            vrvInvOptions.vin_num,
            vrvInvOptions.description
        FROM vrvInventory 
        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
        WHERE  visibility = 'Show' $search_stmt
        ORDER BY vrvInventory.type, vrvInventory.sale
        LIMIT $startrow, " . SHOWMAX;
    
    // submit the query and capture the result
    
    $result = $conn->query($sql) or die(mysqli_error($conn));

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
				<h3>Premier Pre-Owned from Vogt RV</h3>
			</div>
		</div>
	</div>
	
	<!--
	<div class="full-width page-head color-secondary-yellow-lt-2">
		<div class="row">
			<h5>Pre-Owned Navigation</h5>
		</div>
	</div>
	-->
	
	<?php  if ($totalInv == 0) { ?>

        <div class="full-width-inv no-inv">
    
            <div class="row">
                <div class="twelve columns">
                    <p>No inventory at this time.</p>
                </div>
            </div>
            
        </div>
        
        <div id="feature-inv" class="full-width featured-units">
			    
		    <p>Featured Units</p>
		    
        </div>        
        
    <?php } else { ?>
    
    	<div class="full-width color-secondary-yellow">
    	
    		<div class="row">
				<ul class="pre-owned-units">
				
				<!-- Beginning of  pre-owned inv loop -->
					
					<?php while ($row = $result->fetch_assoc()) { ?>
					
						<li>
			                <div class="pre-owned-unit">
	                            <h5><?php echo $row['year']; ?> <?php echo $row['make']; ?></h5>
	                            <h6><?php echo $row['model']; ?> <?php echo $row['model_num']; ?></h6>
	                                <div class="featured-img">
	                                    <?php 
	                                    
                                        $imgdir = "unit-img/" . $row['stockNum'] . "/";
                                        $unit_imgs = glob($imgdir."*.jpg");
                                                       
                                        if (empty($unit_imgs)) {
                                    
                                            echo  '<img src="img/img-coming-soon.png" alt="">';
                                    
                                        } else {
                                    
                                            $main_img = $unit_imgs[0];
                                            echo  '<img src="'. $main_img .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">';
                                
                                        }   ?>
	                                </div>
    	                            <a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>"  class="orange-btn">
	    	                            <?php if ($row['sale'] > 0) { ?>
		                            		 <?php echo money_format('%.0n', $row['sale']); ?>
		                            	<?php } else { ?>
		                            		Get More Info
		                            	<?php } ?>
    	                            </a>
								</div>
							</li>
			        
						<?php } ?>
				            
				    <!-- End of loop -->   
				    
				    </ul>
			    </div>
		    </div>
		    
	    <?php } ?>
	    
	    <?php  if ($totalInv > 8) {  ?>
    
	<div class="paginate">
	    <div class="row">
		    <div class="centered four columns ">
                
                    <ul class="pagination tiles">
                
                        <?php 
                        
                        // Create a back link if current page greater than 0 
                        
                        if ($curPage > 0) {
                            echo '<li class="blue-btn"><a href="' . $_SERVER['PHP_SELF'] . '?curPage=' . ($curPage-1) . $search_url . '">&laquo; Previous</a></li>';
                        }   else {
                            echo '<li>&nbsp;</li>';
                        }
                        
                        ?>
                         
                        
                        <?php 
                        
                        // Create a forward link if more records exist
                        
                        if ($startrow+SHOWMAX < $totalInv) {
                            echo '<li class="blue-btn"><a href="' . $_SERVER['PHP_SELF'] . '?curPage=' . ($curPage+1) . $search_url . '">Next &raquo;</a></li>';
                        }   else {
                            echo '<li>&nbsp;</li>';
                        }
                        
                        ?>
                       
                    </ul>
                
		    </div>
	    </div>
    </div>
    <?php } ?>
	
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
