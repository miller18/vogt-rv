<?php 

	include('includes/title.inc.php');
	require_once('includes/connection.inc.php');
	$dealership = 'Both';

	$conn = dbConnect('write');
    $sql = "SELECT 
	     	vrvInventory.vin,
            vrvInventory.year, 
            vrvInventory.make, 
            vrvInventory.model, 
            vrvInventory.model_num, 
            vrvInventory.msrp, 
            vrvInventory.no_hassle, 
            vrvInventory.dealmaker, 
            vrvInventory.special_price,
            vrvInventory.specials, 
            vrvInventory.type, 
            vrvInventory.location, 
            vrvInventory.unit_condition, 
            vrvInvOptions.int_color, 
            vrvInvOptions.ext_color, 
            vrvInventory.status, 
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
            vrvInvStandards.video_link,
            vrvInvStandards.map,
            vrvInvStandards.map_priced
        FROM vrvInventory 
        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
        LEFT JOIN vrvInvStandards ON vrvInventory.model_num = vrvInvStandards.model_num AND vrvInventory.model = vrvInvStandards.model AND vrvInventory.year = vrvInvStandards.year
        WHERE (vrvInventory.stockNum = ?)";
    

    $stocknumber = $_GET['stockNum'];
    

    $stmt = $conn->stmt_init();
    
    if ($stmt->prepare($sql)) {
        $stmt->bind_param('s', $stocknumber);
        $stmt->bind_result($vin, $year, $make, $model, $model_num, $msrp, $no_hassle, $dealmaker, $special_price, $specials, $type, $location, $condition, $int_color, $ext_color, $status, $options, $miles, $uvw, $vin_num, $description, $standards, $floorplan, $gvwr, $len_ft, $len_in, $slides, $sleeping, $chassis, $engine, $fuel, $bl_water, $gr_water, $fr_water,$img_folder,$video_link,$map_price,$map_restrictions);
        $stmt->execute();
        $stmt->store_result();
        
    } else {
        echo $stmt->error;
    }
    
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
	
	<!-- Inventory Details -->
	
	<?php while ($stmt->fetch()) { ?>
	
	<div class="full-width bg-secondary-blue-lt no-print ">
		<div class="row">
			<div class="twelve columns">
			 	<h3 class="unit-title-detail"><?php echo $year; ?> <?php echo $make; ?> <?php echo $model; ?> <?php echo $model_num; ?></h3>
			</div>
			
		</div>
		 <div class="row">
        	<div class="five columns unit-status">
                <p>Stock Number: <em><?php echo $stocknumber; ?></em> | Status: <em>

                <?php

                 	if ($status == "Sold, Available") {
                 		$coach_status = "Sale Pending";
                 	} else {
                 		$coach_status = $status;
                 	}
                 	
                 	echo $coach_status;

             	?>

                </em> </p>
            </div>
			<div class="seven columns unit-location">
                                        
	            <?php 
	            
	            if ($location == 'South') {
	            
	                echo '<p><strong>Vogt Motorhome Center</strong> 5624 Airport Frwy, Fort Worth, TX 76117 <em>817.831.4222</em></p>';
	            
	            } else {
	                
	                echo '<p><strong>Vogt Family Fun Center</strong> 5301 Airport Frwy, Fort Worth, TX 76117<em>817.831.1800</em></p>';
	                
	            } 
	            
	            ?>
                                        
			</div>
        </div>
	</div>
	
	<div class="print-info">
		<div class="row">
			<h3 class="unit-title-detail"><?php echo $year; ?> <?php echo $make; ?> <?php echo $model; ?> <?php echo $model_num; ?></h3>
		</div>
		 <div class="row unit-status">
			 <p>Stock Number: <em><?php echo $stocknumber; ?></em> | Status: <em><?php echo $status; ?></em> </p>
		 </div>
		 <div class="row unit-location">
	                                
	        <?php 
	        
	        if ($location == 'South') {
	        
	            echo '<p><strong>Vogt Motorhome Center</strong> 5624 Airport Frwy, Fort Worth, TX 76117 <em>817.831.4222</em></p>';
	        
	        } else {
	            
	            echo '<p><strong>Vogt Family Fun Center</strong> 5301 Airport Frwy, Fort Worth, TX 76117<em>817.831.1800</em></p>';
	            
	        } 
	        
	        ?>
                                        
        </div>
		<div class="row">
			<div class="seven columns ">
				<div class="row images">
			
					<?php
					
						$imgdir = "unit-img/" . $stocknumber . "/";
						$unit_imgs = glob($imgdir."*.jpg");
						
						 if ($unit_imgs) {
	                            
							 echo '<ul>';
                        
                             foreach($unit_imgs as $unit_img) {
                            
                                 echo  '<li> <img src="'.$unit_img.'" alt="" title="' . $year . ' ' . $make . ' ' . $model . ' ' . $model_num . '" ></li>';
                            
                             }
                             
                             echo '</ul>';
                             
                         }  else {
	                         echo '<p class="text-centered">No Images Available</p>';
                         }
	                            
					 ?>
				</div>
				<div class="row">
					<p>Optional Equipment</p>
					<ul class="print-options">
                                
	                    <?php 
	                    
	                    	if ($options) {
	                            $option_array = explode(',', $options);
	                            foreach($option_array as $option_feature) {
	                            
	                                echo '<li>' . ucwords(mb_strtolower($option_feature)) . '</li>';
	                                
	                            }
	                        } else {
	                            
	                            echo '<li> Optional equipment Not Available.</li>';
	                            
	                        }
	                    
	                    ?>
                    
                    </ul>
				</div>
			</div>
			<div class="five columns">
				<div class="row">
					<?php if ($floorplan) { ?> 
                		<img src="floorplans/<?php echo $floorplan; ?>">
					<?php } else { ?>
						<p class="text-centered">No Floorplan Available</p>
					<?php } ?>
				</div>
				<div class="row">
					<table>
	                    <tbody>


	                    	<?php if ($msrp) { ?>
	                        <tr>
	                            <td colspan="2">MSRP: <?php echo money_format('%.0n', $msrp);?></td>
	                        </tr>
	                        <?php } else { ?>
	                         <tr>
	                            <td colspan="2">&nbsp;</td>
	                        </tr>   
	                        <?php } ?>
	                        
	                        <?php if ($msrp && $displayed_price > 0) { ?>
	                        <?php  $discount = $msrp - $displayed_price; ?>
	                        <tr>
	                            <td colspan="2">Discount: <?php echo money_format('%.0n', $discount);?></td>
	                        </tr>
	                        <tr>
	                            <td colspan="2" class="sale-price">Sale: <?php echo money_format('%.0n', $displayed_price);?></td>
	                        </tr>
							<?php } ?>
	                    
	                    </tbody>
	                </table>
	                
	                <?php if ($type == 'Travel Trailer' or $type == 'Fifth Wheel' or $type == 'Toy Hauler' or $type == 'Tent Camper') { ?>
                                    
	                    <table class="small">
	                        <tbody>
	                            
	                            <tr>
	                                <td>Class:</td>
	                                <td><?php echo $type; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Condition:</td>
	                                <td><?php echo $condition; ?></td>
	                            </tr>
	                            <tr>
	                                <td>VIN:</td>
	                                <td><?php echo $vin; ?></td>
	                            </tr>
	                            <tr>
	                                <td>UVW:</td>
	                                <td><?php echo $uvw; ?> lbs.</td>
	                            </tr>
	                            <tr>
	                                <td>Travel Length:</td>
	                                <td><?php echo $len_ft; ?>' <?php echo $len_in; ?>"</td>
	                            </tr>
	                            <tr>
	                                <td>Exterior Color:</td>
	                                <td><?php echo ucwords(strtolower($ext_color)); ?></td>
	                            </tr>
	                            <tr>
	                                <td>Interior Color:</td>
	                                <td><?php echo ucwords(strtolower($int_color)); ?></td>
	                            </tr>
	                            <tr>
	                                <td>Slides:</td>
	                                <td><?php echo $slides; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Sleeping:</td>
	                                <td><?php echo $sleeping; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Fresh Water:</td>
	                                <td><?php echo $fr_water; ?> gal.</td>
	                            </tr>
	                            <tr>
	                                <td>Grey Water:</td>
	                                <td><?php echo $gr_water; ?> gal.</td>
	                            </tr>
	                            <tr>
	                                <td>Black Water:</td>
	                                <td><?php echo $bl_water; ?> gal.</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    
	                    <?php } else { ?>
	                    
	                    <table class="small">
	                        <tbody>
	                            
	                            <tr>
	                                <td>Class:</td>
	                                <td><?php echo $type; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Condition:</td>
	                                <td><?php echo $condition; ?></td>
	                            </tr>
	                            <tr>
	                                <td>VIN:</td>
	                                <td><?php echo $vin; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Miles:</td>
	                                <td><?php echo $miles; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Chassis:</td>
	                                <td><?php echo $chassis; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Engine:</td>
	                                <td><?php echo $engine; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Exterior Color:</td>
	                                <td><?php echo ucwords(strtolower($ext_color)); ?></td>
	                            </tr>
	                            <tr>
	                                <td>Interior Color:</td>
	                                <td><?php echo ucwords(strtolower($int_color)); ?></td>
	                            </tr>
	                           <tr>
	                                <td>Slides:</td>
	                                <td><?php echo $slides; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Sleeping:</td>
	                                <td><?php echo $sleeping; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Fresh Water:</td>
	                                <td><?php echo $fr_water; ?> gal.</td>
	                            </tr>
	                            <tr>
	                                <td>Grey Water:</td>
	                                <td><?php echo $gr_water; ?> gal.</td>
	                            </tr>
	                            <tr>
	                                <td>Black Water:</td>
	                                <td><?php echo $bl_water; ?> gal.</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    
	                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="full-width color-secondary-yellow-lt-2 no-print ">
		<div class="row">
			<div class="eight columns">
				<div class="row">
				
					<section class="tabs unit-details">
					
						<ul class="tab-nav">
							<li class="active"><a href="#">Images</a></li>
							<li> <a href="#">Floorplan</a></li>
							<li><a href="#">Videos</a></li>
						</ul>
						
						<div class="tab-content active">
							<div class="row detail-rotation">
								
								<?php 
                                    
                                     if (!$unit_imgs) {
                                
										 if ($img_folder) {
	                            
				                            	$imgdir = "unit-img/generic-img/" . $img_folder. "/";
				                            	
				                            	$unit_imgs = glob($imgdir."*.jpg");
				                            	
				                            		echo '<ul class="bxslider">';
													
													foreach($unit_imgs as $unit_img) {
                                        
			                                             echo  '<li> <img src="'.$unit_img.'" alt=""> </li>';
			                                        
			                                         }
			                                         
			                                         echo '</ul>';
				                            	
				                            	} else {
				                     				echo  '<div><img src="img/img-coming-soon.png" alt=""></div>';       	
				                            	}
                                         
                                     } else {
                                    
										 echo '<ul class="bxslider">';
                                    
                                         foreach($unit_imgs as $unit_img) {
                                        
                                             echo  '<li> <img src="'.$unit_img.'" alt="" title="' . $year . ' ' . $make . ' ' . $model . ' ' . $model_num . '" ></li>';
                                        
                                         }
                                         
                                         echo '</ul>';
                                         
                                     }
                                    
                                    ?>
								</div>
						</div>
						<div class="tab-content floorplan">
							<?php if ($floorplan) { ?> 
                            	<a  href="#" class="switch" gumby-trigger="#floorplanModal"><img src="floorplans/<?php echo $floorplan; ?>"></a>
                           <?php } else { ?>
                           		<p>No Floorplan Available</p>
                           <?php } ?>
						</div>
						<div class="tab-content">
							<p>No Videos Available</p>
						</div>
					
					</section>
				</div>
				<div class="row">
					<div class="three columns sub-img lt-orange-btn">
						<a href="https://www.vogtrv.com/credit-application.php?stocknum=<?php echo $stocknumber; ?>&location=<?php echo $location; ?>" target="_blank">Finance Options</a>
					</div>
					<div class="three columns sub-img lt-orange-btn">
						<a  href="#" class="switch" gumby-trigger="#tradeModal">Trade Value</a>
					</div>
					<div class="three columns sub-img lt-orange-btn">
						<a href="#" class="switch" gumby-trigger="#reserveModal">Buy It Now!</a>
					</div>
					<script>
					function printpage() {
						window.print()
					}
					</script>
					<div class="three columns sub-img lt-orange-btn">
						<a href="dealmaker.php?stocknum=<?php echo $stocknumber; ?>" target="_blank"  onclick="MM_openBrWindow('dealmaker.php?stocknum=<?php echo $stocknumber; ?>','The RV Dealmaker','scrollbars=yes,width=800,height=550'); return false;">RV Dealmaker</a>
					</div>
				</div>
			</div>
			<div class="four columns">
				<section class="tabs unit-specs">
					
				<ul class="tab-nav">
					<li class="active"><a href="#">Price</a></li>
					<li> <a href="#">Specs</a></li>
				</ul>
				<div class="tab-content  pricing active">
					<table>
	                    <tbody>
	                    	
	                    	<?php

	                    	$sale_price_tag = 'No Hassle Price';

	                                if ($map_restrictions == 'yes') {
	                                	$displayed_price = '0';
	                                } elseif ($map_restrictions == 'no') {
	                                	if ($specials) {	
	                                		$displayed_price = $special_price;
	                                		$sale_price_tag = 'Managers Special';

	                                	} else {
	                                		$displayed_price = $no_hassle;
	                                	}
									} else {
										$displayed_price = $no_hassle;
									}


							?>
	                    	<?php if ($msrp) { ?>
	                        <tr>
	                            <td colspan="2" class="msrp">MSRP: <?php echo money_format('%.0n', $msrp);?></td>
	                        </tr>
	                        <?php } else { ?>
	                         <tr>
	                            <td colspan="2">&nbsp;</td>
	                        </tr>   
	                        <?php } ?>
	                        
	                        <?php if ($displayed_price > 0) { ?>
	                        	<?php if ($msrp) { ?>	
			                        <?php  $discount = $msrp - $displayed_price; ?>
			                        <tr>
			                            <td colspan="2" class="discount">Discount: <?php echo money_format('%.0n', $discount);?></td>
			                        </tr>
		                        <?php  } ?>
		                        <tr>
		                        	<?php if ($specials) { ?>
										<td colspan="2" class="special sale-price">
											<div class="price-tag">
												<?php echo $sale_price_tag; ?>
											</div> 
											<div class="price">
												<?php echo money_format('%.0n', $displayed_price);?>
											</div>
										</td>
		                        	<?php } else { ?>
		                            	<td colspan="2" class="sale-price">
											<div class="price-tag">
												<?php echo $sale_price_tag; ?>
											</div> 
											<div class="price">
												<?php echo money_format('%.0n', $displayed_price);?>
											</div>
										</td>
		                            <?php } ?>
		                        </tr>
	                        <?php } else { ?>
	                         
							<tr rowspan="2">
								<?php if ($specials) { ?>
									<td colspan="2" ><a href="dealmaker.php?stocknum=<?php echo $stocknumber; ?>" target="_blank" class="green-btn"  onclick="MM_openBrWindow('dealmaker.php?stocknum=<?php echo $stocknumber; ?>','The RV Dealmaker','scrollbars=yes,width=800,height=550'); return false;">Manager's Special</a></td>
								<?php } else { ?>
									<td colspan="2" ><a href="dealmaker.php?stocknum=<?php echo $stocknumber; ?>" target="_blank" class="orange-btn"  onclick="MM_openBrWindow('dealmaker.php?stocknum=<?php echo $stocknumber; ?>','The RV Dealmaker','scrollbars=yes,width=800,height=550'); return false;">RV Dealmaker</a></td>
								<?php } ?>	
	                        </tr>	
								
							<?php } ?>
	                    
	                    </tbody>
	                </table>
					<div class="detail-payment-calc">
		            	<form>
		                   	<table>
		                        <thead>
		                            <tr>
		                                <td colspan="2">Payment Calculator</td>
		                            </tr>
		                        </thead>
		                         <tbody>
		                            <tr>
		                                <td>Sale Price:</td>
		                                <td><input type="text" name="sale_price" /></td>
		                            </tr>
		                            <tr>
		                                <td>Term:</td>
		                                <td>
		                                    <select name="term">
												<option value="60">60 months</option>
												<option value="72">72 months</option>
												<option value="84">84 months</option>
												<option value="96">96 months</option>
												<option value="120">120 months</option>
												<option value="180">180 months</option>
												<option value="240">240 months</option>
		                                    </select>
		                                </td>
		                             </tr>
		                            <tr>
		                                <td>Rate:</td>
		                                <td><input type="irate" name="rate"/></td>
		                            </tr>
		                            <tr>
		                                <td>Down Payment:</td>
		                                <td><input type="downpayment" name="payment" /></td>
		                            </tr>
		                            <tr>
		                                <td colspan="2">
		                                	<div class="row">
		                                		<div class="six columns">
													<div class="payment-btn" name="Input"  type="button"  onclick="calcpayments()">Calculate payments</div>
		                                		</div>
		                                		<div class="six columns">
													<div class="payment-btn" name="reset2" type="reset" > Clear</div>
		                                		</div>
		                                	</div>
										</td>
		                            </tr>
		                            <tr>
		                            	<td colspan="2">Estimated Payment: $<span id="monthlypayment"></span></td>
		                            </tr>
		                            
		                        </tbody>
		                    </table>
	                    </form>
		            </div>
		             <?php if ($condition == 'New') { 
		             		
	             		$filename = "msrp/" . $stocknumber . ".pdf" ;
						if (count(glob($filename)) > 0) { ?>
		                    <div class="orange-btn">
		                        <a href="/msrp/<?php echo $stocknumber; ?>.pdf" target="_blank" class="button">Download the MSRP</a>
		                    </div>
	                    <?php } ?>
                    <?php } ?>
		        </div>
				<div class="tab-content specs-table">
					<?php if ($type == 'Travel Trailer' or $type == 'Fifth Wheel' or $type == 'Toy Hauler' or $type == 'Tent Camper') { ?>
                                    
	                    <table class="striped">
	                        <tbody>
	                            
	                            <tr>
	                                <td>Class:</td>
	                                <td><?php echo $type; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Condition:</td>
	                                <td><?php echo $condition; ?></td>
	                            </tr>
	                            <tr>
	                                <td>VIN:</td>
	                                <td><?php echo $vin; ?></td>
	                            </tr>
	                            <tr>
	                                <td>UVW:</td>
	                                <td><?php echo $uvw; ?> lbs.</td>
	                            </tr>
	                            <tr>
	                                <td>Travel Length:</td>
	                                <td><?php echo $len_ft; ?>' <?php echo $len_in; ?>"</td>
	                            </tr>
	                            <tr>
	                                <td>Exterior Color:</td>
	                                <td><?php echo ucwords(strtolower($ext_color)); ?></td>
	                            </tr>
	                            <tr>
	                                <td>Interior Color:</td>
	                                <td><?php echo ucwords(strtolower($int_color)); ?></td>
	                            </tr>
	                            <tr>
	                                <td>Slides:</td>
	                                <td><?php echo $slides; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Sleeping:</td>
	                                <td><?php echo $sleeping; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Fresh Water:</td>
	                                <td><?php echo $fr_water; ?> gal.</td>
	                            </tr>
	                            <tr>
	                                <td>Grey Water:</td>
	                                <td><?php echo $gr_water; ?> gal.</td>
	                            </tr>
	                            <tr>
	                                <td>Black Water:</td>
	                                <td><?php echo $bl_water; ?> gal.</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    
	                    <?php } else { ?>
	                    
	                    <table class="striped">
	                        <tbody>
	                            
	                            <tr>
	                                <td>Class:</td>
	                                <td><?php echo $type; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Condition:</td>
	                                <td><?php echo $condition; ?></td>
	                            </tr>
	                            <tr>
	                                <td>VIN:</td>
	                                <td><?php echo $vin; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Miles:</td>
	                                <td><?php echo $miles; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Chassis:</td>
	                                <td><?php echo $chassis; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Engine:</td>
	                                <td><?php echo $engine; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Exterior Color:</td>
	                                <td><?php echo ucwords(strtolower($ext_color)); ?></td>
	                            </tr>
	                            <tr>
	                                <td>Interior Color:</td>
	                                <td><?php echo ucwords(strtolower($int_color)); ?></td>
	                            </tr>
	                           <tr>
	                                <td>Slides:</td>
	                                <td><?php echo $slides; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Sleeping:</td>
	                                <td><?php echo $sleeping; ?></td>
	                            </tr>
	                            <tr>
	                                <td>Fresh Water:</td>
	                                <td><?php echo $fr_water; ?> gal.</td>
	                            </tr>
	                            <tr>
	                                <td>Grey Water:</td>
	                                <td><?php echo $gr_water; ?> gal.</td>
	                            </tr>
	                            <tr>
	                                <td>Black Water:</td>
	                                <td><?php echo $bl_water; ?> gal.</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    
	                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="full-width bg-secondary-blue-dk-2 no-print ">
		<div class="row">
			<div class="six columns">
				<div class="row">
					<section class="tabs unit-additional-details">
					
						<ul class="tab-nav">
							<li class="active"><a href="#">Options</a></li>
							<?php if ($condition == 'New') { ?>
								<li> <a href="#">Standards</a></li>
							<?php } ?>
						</ul>
						
						<div class="tab-content optional-equip active ">
							<ul>
                                
                                <?php 
                                
                                	if ($options) {
	                                    $option_array = explode(',', $options);
	                                    foreach($option_array as $option_feature) {
	                                    
	                                        echo '<li>' . ucwords(mb_strtolower($option_feature)) . '</li>';
	                                        
	                                    }
                                    } else {
	                                    
	                                    echo '<li> Optional equipment is coming soon.</li>';
	                                    
                                    }
                                
                                ?>
                                
                                </ul>
						</div>
						<div class="tab-content standard-equip">
							 <ul>
                                <?php 
                                
                                    $standard_array = explode(',', $standards);
                                    foreach($standard_array as $standard_feature) {
                                    
                                        echo '<li>' . ucwords(mb_strtolower($standard_feature)) . '</li>';
                                        
                                    }
                                
                                ?>
                            </ul>
						</div>
					
					</section>
				</div>
				<div class="row disclaimer">
	                <p>Vogt RV Center, Inc. has made every effort to ensure accuracy in the information provided. All sale prices include any and all other incentives, offers and rebates offered by Vogt RV Center or any other manufacturer unless specified in writing. Specifications, equipment, technical data, photographs and illustrations are based on information available at time of posting and are subject to change without notice. Online information deemed reliable, but not guaranteed. Due to high volume sales some videos and pictures may not represent actual vehicle for sale. Any prices listed on this site are subject to change without notice and do not include tax and license fees. All units are subject to prior sale. All weights and measurements are approximate and NOT guaranteed to be 100% accurate. Verify all information prior to purchase.</p>
                </div>
			</div>
			<div class="six columns">
				<?php include('includes/similar-units.php'); ?>
			</div>
		</div>
	</div>
			
	
	<?php } ?>
		
	<?php include('includes/main-footer.php'); ?>
	
	<!-- Floorplan Modal -->
	
	<div class="modal" id="floorplanModal">
		<div class="content">
			<a class="close switch" gumby-trigger="|#floorplanModal"><i class="icon-cancel"></i></a>
			<div class="row">
				<div class="twelve columns centered text-center">
						<h4>Flooplan</h4>
						<p><img src="floorplans/<?php echo $floorplan; ?>" /></p>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Trade Modal -->
    
    <div class="modal" id="tradeModal">
		<div class="content">
			<a class="close switch" gumby-trigger="|#tradeModal"><i class="icon-cancel"></i></a>
			<div class="row">
				<div class="ten columns centered text-center">
					<ul>
						<li><a href="coach-evaluation-mh.php?stockNum=<?php echo $stocknumber; ?>">Motorized Trade</a></li>
						<li><a href="coach-evaluation-tt.php?stockNum=<?php echo $stocknumber; ?>">Towable Trade</a></li>
					</ul>
				</div>
			</div>
		</div>
    </div>
    
    <!-- Reserve Modal -->
    
     <div class="modal" id="reserveModal">
		<div class="content">
			<a class="close switch" gumby-trigger="|#reserveModal"><i class="icon-cancel"></i></a>
			<div class="row">
				<div class="ten columns centered">
					<?php
						$refundable = "yes";
						if ($model == "Zephyr") {
							$charge_amount="5000.00";
						}else{
							if ($type == "Travel Trailer" or $type == "Fifth Wheel") {
								if ($condition == "New") {
									$charge_amount="500.00";	
								} else {
									$refundable = "no";
									if ($condition == "Pre Owned" and $make == "Airstream") {
										$charge_amount = "1000.00";
									}  else {
										$charge_amount = "500.00";
									}
								}
								
							}else{
								$charge_amount="1000.00";
							}
						}
					?>
					<h4>Buy This RV Now!</h4>
					<p>Don't miss out on this incredible opportunity!  Take advantage of the savings and purchase this RV with a deposit of only $<?php echo $charge_amount; ?>.</p>
					<p>Simply click to the link below to be taken to our Secure Deposit Portal.</p>
					<p><a href="https://vogtrv.com/checkout_form2.php?stock_num=<?php echo $stocknumber; ?>&charge_amount=<?php echo $charge_amount; ?>&charge_reason=Deposit&refundable=<?php echo $refundable; ?>">Click Here to Continue to Vogt RV's Secure Deposit Portal</a></p>
				</div>
			</div>
		</div>
    </div>
    
    <!-- AddThis Smart Layers BEGIN -->
	<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52cac9a03c9fb026"></script>
	<script type="text/javascript">
	  addthis.layers({
	    'theme' : 'transparent',
	    'share' : {
	      'position' : 'left',
	      'numPreferredServices' : 5
	    }   
	  });
	</script>
	<!-- AddThis Smart Layers END -->
	
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
	
	<script>
		function MM_openBrWindow(theURL,winName,features) { //v2.0
		  window.open(theURL,winName,features);
		}
	</script>
	
	<script>
		function calcpayments(){
			
			//The five variables we are going to use in the formula
			
			var nprice=document.forms[0].sale_price.value*1;
			var interest=document.forms[0].rate.value*1;
			var dpayment=document.forms[0].payment.value*1;
			
			var t;
			
			//We used a loop to select the term for the payments
			
			for (i=0; i<document.forms[0].term.options.length; i++)
			
			{
			
			if (document.forms[0].term.options[i].selected)
			t = document.forms[0].term.options[i].value*1;
			}
			
			//This is the formula that does the math
			
			var result=(nprice-dpayment)*((interest/100)/12) / (1-Math.pow((1+(interest/100)/12),(-t)));
			
			result=Math.round(result*100) /100;
			
			
			//The line below shows the result in the box
			
			document.getElementById("monthlypayment").innerHTML=result;
			
		}
	</script>

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
