<?php 

	include('includes/title.inc.php'); 
	$dealership = 'Both';
	require_once('includes/connection.inc.php');
    
    $conn = dbConnect('write');
	$pos = 0;
    $firstrow = true;
   
    $conn = dbConnect('write');
    define('SHOWMAX', 8);
   
    $search_stmt = '';
    $search_url = '';
    $search_variables = array($_GET['type'],$_GET['unit_condition'], $_GET['location'],$_GET['make'],$_GET['model']);
    $search_conditions = array('vrvInventory.type', 'vrvInventory.unit_condition', 'vrvInventory.location', 'vrvInventory.make', 'vrvInventory.model');
    $search_url_tags = array('type','unit_condition','location','make','model');
    $counter = 0;
    
    foreach($search_variables as $search_variable) {
        
        if($search_variable) {
            $search_stmt .=" and $search_conditions[$counter] = '$search_variable'"; 
            $search_url .="&$search_url_tags[$counter]=$search_variable";
        } 
        
        $counter++;
        
    }
    
    $getTotal = "SELECT COUNT(*) FROM vrvInventory WHERE  visibility = 'Show' AND show_unit = 'Yes' $search_stmt";
    
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
            vrvInventory.lot_price, 
            vrvInventory.show_price, 
            vrvInventory.type, 
            vrvInventory.location, 
            vrvInventory.unit_condition, 
            vrvInvOptions.int_color, 
            vrvInvOptions.ext_color, 
            vrvInventory.status, 
            vrvInventory.visibility, 
            vrvInventory.timeStamp,
            vrvInvOptions.options,
            vrvInvOptions.miles,
            vrvInvOptions.uvw,
            vrvInvOptions.vin_num,
            vrvInvOptions.description,
            vrvInvStandards.standards,
            vrvInvStandards.floorplan, 
            vrvInvStandards.gvwr,
            vrvInvStandards.unit_length_ft, 
            vrvInvStandards.unit_length_in,
            vrvInvStandards.slides,
            vrvInvStandards.sleeping_capacity,
            vrvInvStandards.chassis,
            vrvInvStandards.engine,
            vrvInvStandards.fuel_type,
            vrvInvStandards.black_water,
            vrvInvStandards.grey_water,
            vrvInvStandards.fresh_water,
            vrvInvStandards.generic_img_folder
        FROM vrvInventory 
        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
        LEFT JOIN vrvInvStandards ON vrvInventory.model_num = vrvInvStandards.model_num AND vrvInventory.model = vrvInvStandards.model AND vrvInventory.year = vrvInvStandards.year
        WHERE  visibility = 'Show' AND show_unit = 'Yes' $search_stmt
        ORDER BY vrvInventory.make, vrvInventory.model, vrvInventory.model_num
        LIMIT $startrow, " . SHOWMAX;
        
           
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

	<title>Vogt RV's Pre-Spring Value Sale | Travel Trailers | Fifth Wheels | Motorhomes</title>
	
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
			<div class="twelve columns text-centered">
					<h2>VOGT RV IS THE VALUE LEADER!</h2>
			</div>
		</div>
	</div>
	
	<div class="full-width  color-secondary-yellow-lt-2">
		<div class="row">
			<div class="twelve columns text-centered">
					<h5>Vogt RV's Pre-Spring Value Sale is going on now!</h5>
					<h5>Take advantage of discounted prices on our already incredibly priced coaches.</h5>
			</div>
		</div>
	</div>
	
	<div class="full-width show-nav bg-secondary-blue-lt">
		<div class="row">
			<div class="two columns blue-btn">
					<a href="rv-inventory-rv-show.php?type=Travel Trailer">Travel Trailers</a>
			</div>
			<div class="two columns blue-btn">
					<a href="rv-inventory-rv-show.php?type=Fifth Wheel">Fifth Wheels</a>
			</div>
			<div class="two columns blue-btn">
					<a href="rv-inventory-rv-show.php?type=Diesel Pusher">Diesel Pushers</a>
			</div>
			<div class="two columns blue-btn">
					<a href="rv-inventory-rv-show.php?type=Class A">Class A</a>
			</div>
			<div class="two columns blue-btn">
					<a href="rv-inventory-rv-show.php?type=Class B">Class B</a>
			</div>
			<div class="two columns blue-btn">
					<a href="rv-inventory-rv-show.php?type=Class C">Class C</a>
			</div>
		</div>
	</div>
	
	<div class="full-width">
        <div class="row">
		    <div class="twelve columns show-inv">
		    
		    	<table class="striped">
		    		<tbody>
		    			
		    			<?php while ($row = $result->fetch_assoc()) {  ?>
		    			
		    			<tr>
		    				<td>
		    					<div class="row">
		    						<div class="four columns">
										<a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>">
				    					<?php 
		                      		
					                   		 $imgdir = "unit-img/" . $row['stockNum'] . "/";
									   		 $imgdir_sm = "unit-img-sm/" . $row['stockNum'] . "/";
									   		 
									   		 $unit_imgs = glob($imgdir."*.jpg");
									   		 $unit_imgs_sm = glob($imgdir_sm."*.jpg");
									   		 
									   		 if (!$unit_imgs_sm) {
									   		 					   		 
										   		 if ($row['generic_img_folder']) {
					                            
					                            	$imgdir = "unit-img/generic-img/" . $row['generic_img_folder'] . "/";
					                            	$imgdir_sm = "unit-img/generic-img/" . $row['generic_img_folder'] . "/";
					                            	
					                            	$unit_imgs = glob($imgdir."*.jpg");
					                            	$unit_imgs_sm = glob($imgdir_sm."*.jpg");
					                            	
					                            	
					                            	$main_img = $unit_imgs_sm[0];
					                                echo  '<a href="#"> <img src="'. $main_img .'" alt=""></a></span>';
					                            
					                            } else  {
					                                
					                                $main_img = 'img/img-coming-soon.png';
					                                
					                                echo  '<img src="' . $main_img . '" alt="">';
				                                
				                                }
				                                
				                            } else {
				                                
					                            $main_img = $unit_imgs_sm[0];
				                            	echo  '<img src="'. $main_img .'" alt="">';
				                            
				                            }
		                        
										?>
										</a>
		    						</div>
		    						<div class="eight columns">
		    							<h4><a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>"><?php echo $row['year']; ?> <?php echo $row['make']; ?> <?php echo $row['model']; ?> <?php echo $row['model_num']; ?></a></h4>
										<p class="small">Stock Number: <?php echo $row['stockNum']; ?></p>
										<p>MSRP:  <?php echo money_format('%.0n', $row['msrp']);?></p>
										<a href="early-show-pricing.php?stocknum=<?php echo $row['stockNum']; ?>" target="_blank" class="orange-btn"  onclick="MM_openBrWindow('early-show-pricing.php?stocknum=<?php echo  $row['stockNum']; ?>','Early Show Pricing','scrollbars=yes,width=800,height=700'); return false;">Get Our Value Sale Price</a>
										&nbsp; &nbsp;
										<?php 
										$filename = "msrp/" . $row['stockNum'] . ".pdf" ;
										if (count(glob($filename)) > 0) { ?>
										    <a href="/msrp/<?php echo $row['stockNum']; ?>.pdf" target="_blank" class="blue-btn" >Download the MSRP</a>
										<?php	}	?>
		    						</div>
		    					</div>
		    				</td>
		    			</tr>
		    			
		    			<?php } ?>
		    			
		    		</tbody>
		    	</table>
		        		                
		    </div>
        </div>
    </div>  	
    
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
	<script>
		<!--
		
		function MM_openBrWindow(theURL,winName,features) { //v2.0
		  window.open(theURL,winName,features);
		}
		//-->
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
