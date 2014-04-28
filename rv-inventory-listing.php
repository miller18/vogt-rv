<?php 

	include('includes/title.inc.php');
	require_once('includes/connection.inc.php');
	$dealership = 'Both';
	
	$conn = dbConnect('write');
	$pos = 0;
    $firstrow = true;
   
    $conn = dbConnect('write');
    define('SHOWMAX', 8);
   
    $search_stmt = '';
    $search_url = '';
    $search_variables = array($_GET['type'],$_GET['unit_condition'], $_GET['location'],$_GET['make'],$_GET['model'], $_GET['specials']);
    $search_conditions = array('vrvInventory.type', 'vrvInventory.unit_condition', 'vrvInventory.location', 'vrvInventory.make', 'vrvInventory.model', 'vrvInventory.specials');
    $search_url_tags = array('type','unit_condition','location','make','model','specials');
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
            vrvInventory.no_hassle, 
            vrvInventory.special_price,
            vrvInventory.specials, 
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
            vrvInvStandards.generic_img_folder,
            vrvInvStandards.map,
            vrvInvStandards.map_priced
        FROM vrvInventory 
        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
        LEFT JOIN vrvInvStandards ON vrvInventory.model_num = vrvInvStandards.model_num AND vrvInventory.model = vrvInvStandards.model AND vrvInventory.year = vrvInvStandards.year
        WHERE  visibility = 'Show' $search_stmt
        ORDER BY vrvInventory.year,  vrvInventory.make, vrvInventory.model, vrvInventory.model_num
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

	<?php  if ($totalInv == 0) { ?>

	<div class="row inventory-listing no-inv">

        <div class="row">
            <p class="text-centered">No inventory at this time.</p>
        </div>
        
		<?php include('includes/featured-units.php'); ?>
        
	</div>
        
    <?php } else { ?>
    
    <!-- Beginning of Inventory Loop -->
    
    <?php while ($row = $result->fetch_assoc()) { ?>
	<div class="inventory-listing">
    
	<div class="row">
    
		<table class="rounded inv-table">
			<thead>
				<tr>
					<th class="unit-title"> <a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>"><?php  echo $row['year']; ?> <?php echo $row['make']; ?> <?php echo $row['model']; ?> <?php echo $row['model_num']; ?></a></th>
					
				</tr>
			</thead>
			<tbody>
				<tr>
					<td> 
						<div class="row">
						<div class="three columns thumbnail" >
						
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
	                                
	                                echo  '<span><img src="' . $main_img . '" alt=""></span>';
                                
                                }
                                
                            } else {
                                
	                            $main_img = $unit_imgs_sm[0];
                                //echo  '<a href="rv-details.php?stockNum=' . echo $row['stockNum'] . '"> <img src="'. $main_img .'" alt=""></a></span>';
                                
                                //start brants watermark image
                            	$quality=80;
                            	
                            	if ($row['status'] == 'Sold') {
                            	
                                	echo  '<a href="rv-details.php?stockNum=' .  $row['stockNum'] . '"> <img src="../includes/watermark2.php?hash=<?php echo time()?>&image='.$main_img.'&quality='.$quality.'&watermark=soldRedSmall.png" alt=""></a></span>';
								
								} elseif ($row['status'] == 'Sold, Available') {
									echo  '<a href="rv-details.php?stockNum=' .  $row['stockNum'] . '"> <img src="../includes/watermark2.php?hash=<?php echo time()?>&image='.$main_img.'&quality='.$quality.'&watermark=salePendingRedSmall.png" alt=""></a></span>';
								
								} elseif (fnmatch('*BH*', $row['model_num'])) {
									echo  '<a href="rv-details.php?stockNum=' .  $row['stockNum'] . '"> <img src="../includes/watermark2.php?hash=<?php echo time()?>&image='.$main_img.'&quality='.$quality.'&watermark=bunkhouseRedSmall.png" alt=""></a></span>';
								
								} elseif (fnmatch('*RK*', $row['model_num'])) {
									echo  '<a href="rv-details.php?stockNum=' .  $row['stockNum'] . '"> <img src="../includes/watermark2.php?hash=<?php echo time()?>&image='.$main_img.'&quality='.$quality.'&watermark=rearKitchenRedSmall.png" alt=""></a></span>';
								
								} elseif ($row['timeStamp'] <> '0000-00-00 00:00:00') {
									 if (date_diff(date_create(date('d-M-Y', ($row['timeStamp']))), date_create(date('d-M-Y', time())))/(60 * 60 * 24) < 7 ) {
										echo  '<a href="rv-details.php?stockNum=' .  $row['stockNum'] . '"> <img src="../includes/watermark2.php?hash=<?php echo time()?>&image='.$main_img.'&quality='.$quality.'&watermark=justListedBlueSmall.png" alt=""></a></span>';
									}
									
								} else {
									echo  '<span><img src="' . $main_img . '" alt=""></span>';
								}
								//end brants watermark image
                            
                            }
                        
                        ?>
								
						
						
						</div>
						<div class="six columns details">
							<section class="tabs pill">

								<ul class="tab-nav">
									<li class="active"><a href="#">Specs</a></li>
									<li><a href="#">Floorplan</a></li>
									<li><a href="#">Description</a></li>
								</ul>
								
								<div class="tab-content active specs">
								
									<?php if ($row['type'] == 'Travel Trailer' or $row['type'] == 'Fifth Wheel' or $row['type'] == 'Toy Hauler' or $row['type'] == 'Tent Camper' )  { ?>
									
										<p>
	                                        Stock Number: <?php echo $row['stockNum']; ?><br>
	                                        Interior Color: <?php echo $row['int_color']; ?><br>
	                                        Exterior Color: <?php echo $row['ext_color']; ?><br>
	                                        UVW: <?php echo $row['uvw']; ?><br>
	                                        Travel Length: <?php echo $row['unit_length_ft']; ?>' <?php echo $row['unit_length_in']; ?>"<br>
	                                        Slides: <?php echo $row['slides']; ?><br>
	                                        Sleeping: <?php echo $row['sleeping_capacity']; ?><br>
	                                        Fresh Water: <?php echo $row['fresh_water']; ?> gal.<br>
	                                        Grey Water: <?php echo $row['grey_water']; ?> gal.<br>
	                                        Black Water: <?php echo $row['black_water']; ?> gal.<br>
	                                    </p>
                                    
                                    <?php } else { ?>
                           
	                                    <p>
	                                        Stock Number: <?php echo $row['stockNum']; ?><br>
	                                        Interior Color: <?php echo $row['int_color']; ?><br>
	                                        Exterior Color: <?php echo $row['ext_color']; ?><br>
	                                        Fuel Type: <?php echo $row['fuel_type']; ?><br>
	                                        Chassis: <?php echo $row['chassis']; ?> <br>
	                                        Engine: <?php echo $row['engine']; ?><br>
	                                        Miles: <?php echo $row['miles']; ?><br>
	                                        Slides: <?php echo $row['slides']; ?><br>
	                                        Sleeping: <?php echo $row['sleeping_capacity']; ?><br>
	                                        Fresh Water: <?php echo $row['fresh_water']; ?> gal.<br>
	                                        Grey Water: <?php echo $row['grey_water']; ?> gal.<br>
	                                        Black Water: <?php echo $row['black_water']; ?> gal.<br>
	                                    </p>
	                                
	                                <?php } ?>
                                    
								</div>
								<div class="tab-content floorplan">
									<?php 
                                
	                                    $floorplan = $row['floorplan'];
	                                    
	                                    if (isset($floorplan)) {
	                                        echo '<img src="/floorplans/'  . $floorplan . '">';
	                                    } else {
	                                        echo '<p>No Floorplan Available</p>';
	                                    }
	                                    
	                                ?>
									
								</div>
								<div class="tab-content description">
									<p>
                                    
	                                    <?php
	                                    
	                                        if (!empty($row['description'])) {
	                                            
	                                            echo $row['description'];
	                                            
	                                        } else {
	                                            
	                                            echo "Vogt RV is the value leader, and the place to come for your next RV.  This " . $row['year'] . " " . $row['make'] . " " . $row['model'] . " " . $row['model_num']  . " is just an example of the high-quality RVs available at Vogt, your North Texas RV Value leader."; 
	                                            
	                                        }
	                                        
	                                    ?> 
                                    
                                    </p>
								</div>
							
							</section>
							
						</div>
						<div class="three columns pricing">
							
							<table class="inv-pricing">
	                            <tbody>
	                            
	                                <?php if ($row['msrp'] > 0) { ?>
	                            
	                                <tr>
	                                    <td>
											<span class="lt-blue-btn">
	                                    		MSRP:
	                                    		<?php echo money_format('%.0n', $row['msrp']);?>
	                                    	</span>
                                    	</td>
	                                </tr>
	                                
	                                <?php }

	                                $sale_price_tag = 'No Hassle Price';

	                                if ($row['map_priced'] == 'yes') {
	                                	$displayed_price = '0';
	                                } elseif ($row['map_priced'] == 'no') {
	                                	if ($row['specials']) {	
	                                		$displayed_price = $row['special_price'];
	                                		$sale_price_tag = 'Managers Special';

	                                	} else {
	                                		$displayed_price = $row['no_hassle'];
	                                	}
									} else {
										$displayed_price = $row['no_hassle'];
									}


	                                ?>
	                                
	                                <?php if ($displayed_price > 0 && $row['msrp'] > 0) { ?>
	                                
	                                <tr class="discount">
	                                    <td>
	                                    	<span class="lt-yellow-btn">
		                                    	Discount:
		                                    	<?php  $discount = $row['msrp'] - $displayed_price; ?>
		                                    	<?php echo money_format('%.0n', $discount); ?>
		                                    </span>
                                    	</td>
	                                </tr>
	                                   
	                                <?php } ?>
	                                
	                                <?php if ($displayed_price > 0) { ?>
	                                
	                                
	                                <tr>
	                                    <td>
	                                    	<?php if($row['specials'] == '2') { ?>
												<span class="green-btn">
											<?php } else { ?>
												<span class="orange-btn">
											<?php } ?>
												<div class="sale-price-tag"><?php echo $sale_price_tag; ?></div>
	                                    		<div class="sale-price"><?php echo money_format('%.0n', $displayed_price); ?></div>
                                    		</span>
                                    	</td>
	                                </tr>
	                                
	                                <?php } else { ?>
	                                
	                                <tr>
		                                	<?php if($row['specials'] == '2') { ?>
												<td><a href="dealmaker.php?stocknum=<?php echo $row['stockNum']; ?>" target="_blank" class="price-request green-btn"  onclick="MM_openBrWindow('dealmaker.php?stocknum=<?php echo  $row['stockNum']; ?>','The RV Dealmaker','scrollbars=yes,width=800,height=550'); return false;">Manager's Special</a></td>
		                                	<?php } else { ?>
		                                		<td><a href="dealmaker.php?stocknum=<?php echo $row['stockNum']; ?>" target="_blank" class="price-request orange-btn"  onclick="MM_openBrWindow('dealmaker.php?stocknum=<?php echo  $row['stockNum']; ?>','The RV Dealmaker','scrollbars=yes,width=800,height=550'); return false;">Our Special Price</a></td>
		                                    <?php } ?>
	                                </tr>
	                                
	                                <?php } ?>

	                                <tr>
	                                <td>
	                                	<?php 
				                            $filename = "msrp/" . $row['stockNum'] . ".pdf" ;
											if (count(glob($filename)) > 0) { ?>
											    <a href="/msrp/<?php echo $row['stockNum']; ?>.pdf" target="_blank" class="blue-btn" >Download the MSRP</a>
											<?php	}	?> 
	                                </td>

					
	                                </tr>
	                            
	                            </tbody>
	                        </table>
	                        
	                          
							
						</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	
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
    
    <!-- End of Inventory Loop -->

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
