<?php 

	include('includes/title.inc.php');
	require_once('includes/connection.inc.php');
	
	$conn = dbConnect('write');
	$dealership = 'Both';
	$errors = array();
	$missing = array();

	if (isset($_POST['send'])) {
	    // Email processing script
	    
	    include('includes/nuke_magic_quotes.php'); 
	    $to = 'dvogt@vogtrv.com';
	    $subject = 'Coach Evaluation';
	    
	    $expected = array('trade_type', 'trade_year', 'trade_make', 'trade_model', 'trade_model_num','trade_miles','trade_vin', 'trade_engine', 'trade_chassis', 'trade_slides', 'trade_generator', 'trade_generator', 'trade_gen_size', 'trade_gen_hrs', 'trade_ac', 'trade_ac_basement', 'trade_ext', 'trade_patio_awning', 'trade_win_awning', 'trade_slide_awning', 'trade_inverter', 'trade_refer', 'trade_satellite', 'trade_wheels', 'trade_nav', 'trade_camera' ,'trade_surround', 'trade_DVD', 'trade_dualpane', 'trade_combo_washer_dryer', 'trade_stack_washer_dryer', 'trade_hydrohot', 'trade_tile', 'trade_shades', 'trade_cab_tv', 'trade_living_tv', 'trade_bedroom_tv', 'trade_ext_tv', 'trade_con_carpet', 'trade_con_seats', 'trade_con_sofa', 'trade_con_dinette', 'trade_con_cabinets', 'trade_con_refer', 'trade_con_oven', 'trade_con_liner', 'trade_con_bed_spread','trade_con_decals', 'trade_con_paint', 'trade_windshield_damage', 'trade_missing', 'trade_ext_damage', 'trade_int_damage', 'trade_window_damage','trade_window_fogged', 'trade_water_damage', 'trade_wall_delamination', 'trade_everything_working', 'trade_everything_original', 'trade_org_owner', 'trade_smoked', 'trade_lived_in', 'trade_pets', 'trade_batteries', 'trade_manuals',  'trade_bed_spread', 'trade_remotes', 'trade_org_tires', 'trade_tires_match', 'trade_tires_rotted', 'trade_tires_wearing', 'trade_ac_condition', 'trade_dash_ac', 'trade_exhaust', 'trade_further_info', 'trade_owe', 'trade_amount_owed', 'trade_bid', 'trade_interest', 'trade_first_name', 'trade_last_name', 'trade_phone', 'salesman', 'subscribe', 'email' );
	    
	    $required = array('trade_type', 'trade_year', 'trade_make', 'trade_model', 'trade_model_num', 'email');
	        
	    // create additional headers
	   $headers = "From: Coach Evaluation <vogtrv@vogtrv.com>\r\n";
		    
		require('includes/processmail_tbl.inc.php');
		
		if ($mailsent) {
        // inserts data into table
        
	        $ok = false;
	     
	        $stmt = $conn->stmt_init();
	        // create sql
	        $sql = 'INSERT INTO vrvCustomers (first_name, last_name, email_address, source, opt_in, date) VALUES (?, ?, ?, ?, ?, NOW())'; 
		        if ($stmt->prepare($sql)) {
		            $source = 'coach evaluation';
		            // bind parameters and execute statement 
		            $stmt->bind_param('sssss', $trade_first_name, $trade_last_name, $email, $source, $subscribe);
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
				    <h2>Coach Evaluation</h2>
				</div>
			</div>
		</div>
		
		<div class="full-width">
	   		<div class="row">
	        	<div class="twelve columns page-content">
	        		
	        		<form class="trade-form" id="trade_form" name="trade_form" method="post" action="coach-evaluation-mh.php">
			
					<?php if (isset($_POST['send'])) { ?>
		                        
				        <?php if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
				        
				            <p class="alert danger">Sorry, your message could not be sent at this time.</p>
				        
				        <?php } elseif (($missing || $errors) && isset($_POST['send'])) { ?>
				        
				            <p class="alert danger">Please fix the item(s) indicated.</p>
				            
				        <?php } elseif ($mailsent)  { ?>
				        
				            <p class="alert success">Thank you for your inquiry, we will contact you shortly.</p>
				            
				        <?php } ?>  
				
				    <?php } ?>
				    
				    	<div class="row">
							<div class="twelve columns">
		
								<fieldset>
								<legend>RV Information</legend>
								
									<div class="row">
										<div class="two columns field  <?php if ($missing && in_array('trade_type', $missing)) { ?> danger <?php } ?>">
											<div class="picker">
												<select id="trade_type" name="trade_type">
													<option value="#" disabled <?php if (!$_POST) echo "selected"; ?>>RV Type</option>
													<option value="Class A" <?php if ($_POST && $_POST['trade_type'] == 'Class A' && !$mailsent) echo "selected"; ?>>Class A</option>
													<option value="Class B" <?php if ($_POST && $_POST['trade_type'] == 'Class B' && !$mailsent) echo "selected"; ?>>Class B</option>
													<option value="Class C" <?php if ($_POST && $_POST['trade_type'] == 'Class C' && !$mailsent) echo "selected"; ?>>Class C</option>
												</select>
											</div>
										</div>
										
										<div class="two columns field  <?php if ($missing && in_array('trade_year', $missing)) { ?> danger <?php } ?>">
											<input class=" text input"  type="text" name="trade_year" id="trade_year" placeholder="Year" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_year'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										
										<div class="two columns field  <?php if ($missing && in_array('trade_make', $missing)) { ?> danger <?php } ?>">
											<input class=" text input"  type="text" name="trade_make" id="trade_make" placeholder="Make" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_make'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										
										<div class="four columns field  <?php if ($missing && in_array('trade_model', $missing)) { ?> danger <?php } ?>">
											<input class=" text input"  type="text" name="trade_model" id="trade_model" placeholder="Model" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_model'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										
										<div class="two columns field  <?php if ($missing && in_array('trade_model_num', $missing)) { ?> danger <?php } ?>">
											<input class=" text input"  type="text" name="trade_model_num" id="trade_model_num" placeholder="Model Number" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_model_num'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</div>
									<div class="row">
										<div class="three columns field  <?php if ($missing && in_array('trade_miles', $missing)) { ?> danger <?php } ?>">
											<input class=" text input"  type="text" name="trade_miles" id="trade_miles" placeholder="Miles" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_miles'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="three columns field  <?php if ($missing && in_array('trade_vin', $missing)) { ?> danger <?php } ?>">
											<input class=" text input"  type="text" name="trade_vin" id="trade_vin" placeholder="VIN" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_vin'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="three columns field  <?php if ($missing && in_array('trade_engine', $missing)) { ?> danger <?php } ?>">
											<input class=" text input"  type="text" name="trade_engine" id="trade_engine" placeholder="Engine" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_engine'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="three columns field  <?php if ($missing && in_array('trade_chassis', $missing)) { ?> danger <?php } ?>">
											<input class=" text input"  type="text" name="trade_chassis" id="trade_chassis" placeholder="Chassis" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_chassis'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</div>
								</fieldset>
								
								<fieldset>
								<legend>Features and Options</legend>
								
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_slides" name="trade_slides">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Slides</option>
													<option value="0" <?php if ($_POST && $_POST['trade_slides'] == '0' && !$mailsent) echo "selected"; ?>>0</option>
													<option value="1" <?php if ($_POST && $_POST['trade_slides'] == '1' && !$mailsent) echo "selected"; ?>>1</option>
													<option value="2" <?php if ($_POST && $_POST['trade_slides'] == '2' && !$mailsent) echo "selected"; ?>>2</option>
													<option value="3" <?php if ($_POST && $_POST['trade_slides'] == '3' && !$mailsent) echo "selected"; ?>>3</option>
													<option value="4" <?php if ($_POST && $_POST['trade_slides'] == '4' && !$mailsent) echo "selected"; ?>>4</option>
													<option value="5" <?php if ($_POST && $_POST['trade_slides'] == '5' && !$mailsent) echo "selected"; ?>>5</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_generator" name="trade_generator">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Generator</option>
													<option value="Gas" <?php if ($_POST && $_POST['trade_generator'] == 'Gas' && !$mailsent) echo "selected"; ?>>Gas</option>
													<option value="Diesel" <?php if ($_POST && $_POST['trade_generator'] == 'Diesel' && !$mailsent) echo "selected"; ?>>Diesel</option>
													<option value="LP Gas" <?php if ($_POST && $_POST['trade_generator'] == 'LP Gas' && !$mailsent) echo "selected"; ?>>LP Gas</option>
													<option value="None" <?php if ($_POST && $_POST['trade_generator'] == 'None' && !$mailsent) echo "selected"; ?>>None</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<input class=" text input"  type="text" name="trade_gen_size" id="trade_gen_size" placeholder="Gen Size" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_gen_size'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="three columns field">
											<input class=" text input"  type="text" name="trade_gen_hrs" id="trade_gen_hrs" placeholder="Gen Hours" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_gen_hrs'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</div>
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_ac" name="trade_ac">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>A/Cs</option>
													<option value="0" <?php if ($_POST && $_POST['trade_ac'] == '0' && !$mailsent) echo "selected"; ?>>0</option>
													<option value="1" <?php if ($_POST && $_POST['trade_ac'] == '1' && !$mailsent) echo "selected"; ?>>1</option>
													<option value="2" <?php if ($_POST && $_POST['trade_ac'] == '2' && !$mailsent) echo "selected"; ?>>2</option>
													<option value="3" <?php if ($_POST && $_POST['trade_ac'] == '3' && !$mailsent) echo "selected"; ?>>3</option>
													<option value="4" <?php if ($_POST && $_POST['trade_ac'] == '4' && !$mailsent) echo "selected"; ?>>4</option>
												</select>
											</div>
										</div>
									
										<div class="three columns field">
											<div class="picker">
												<select id="trade_ext" name="trade_ext">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Exterior</option>
													<option value="White with decals" <?php if ($_POST && $_POST['trade_ext'] == 'White with decals' && !$mailsent) echo "selected"; ?>>White with decals</option>
													<option value="Full paint with decals" <?php if ($_POST && $_POST['trade_ext'] == 'Full paint with decals' && !$mailsent) echo "selected"; ?>>Full paint with decals</option>
													<option value="Full body paint" <?php if ($_POST && $_POST['trade_ext'] == 'Full body paint' && !$mailsent) echo "selected"; ?>>Full body paint</option>
												</select>
											</div>
										</div>
									
										<div class="three columns field">
											<div class="picker">
												<select id="trade_patio_awning" name="trade_patio_awning">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Patio Awning</option>
													<option value="Power" <?php if ($_POST && $_POST['trade_patio_awning'] == 'Power' && !$mailsent) echo "selected"; ?>>Power</option>
													<option value="Manual" <?php if ($_POST && $_POST['trade_patio_awning'] == 'Manual' && !$mailsent) echo "selected"; ?>>Manual</option>
													<option value="None" <?php if ($_POST && $_POST['trade_patio_awning'] == 'None' && !$mailsent) echo "selected"; ?>>None</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_win_awning" name="trade_win_awning">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Window Awnings</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_win_awning'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_win_awning'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_slide_awning" name="trade_slide_awning">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Slide Awnings</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_slide_awning'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_slide_awning'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_inverter" name="trade_inverter">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Inverter</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_inverter'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_inverter'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_refer" name="trade_refer">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Refrigerator</option>
													<option value="Stack" <?php if ($_POST && $_POST['trade_refer'] == 'Stack' && !$mailsent) echo "selected"; ?>>Stack</option>
													<option value="Side-by-side" <?php if ($_POST && $_POST['trade_refer'] == 'Side-by-side' && !$mailsent) echo "selected"; ?>>Side-by-side</option>
													<option value="Four-door" <?php if ($_POST && $_POST['trade_refer'] == 'Four-door' && !$mailsent) echo "selected"; ?>>Four-door</option>
													<option value="Residential" <?php if ($_POST && $_POST['trade_refer'] == 'Residential' && !$mailsent) echo "selected"; ?>>Residential</option>
												</select>
											</div>
										</div>
									
										<div class="three columns field">
											<div class="picker">
												<select id="trade_surround" name="trade_surround">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Surround Sound</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_surround'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_surround'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_DVD" name="trade_DVD">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>DVD</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_DVD'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_DVD'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_dualpane" name="trade_dualpane">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Dual Pane Windows</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_dualpane'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_dualpane'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_combo_washer_dryer" name="trade_combo_washer_dryer">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Combo Washer/Dryer</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_combo_washer_dryer'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_combo_washer_dryer'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
																		
										<div class="three columns field">
											<div class="picker">
												<select id="trade_stack_washer_dryer" name="trade_stack_washer_dryer">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Stacked Washer/Dryer</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_stack_washer_dryer'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_stack_washer_dryer'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_shades" name="trade_shades">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Day/Night Shades</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_shades'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_shades'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_living_tv" name="trade_living_tv">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Living Room TV</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_living_tv'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_living_tv'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_bedroom_tv" name="trade_bedroom_tv">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Bedroom TV</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_bedroom_tv'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_bedroom_tv'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_ext_tv" name="trade_ext_tv">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Exterior TV</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_ext_tv'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_ext_tv'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_satellite" name="trade_satellite">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Satellite</option>
													<option value="Manual" <?php if ($_POST && $_POST['trade_satellite'] == 'Manual' && !$mailsent) echo "selected"; ?>>Manual</option>
													<option value="Automatic" <?php if ($_POST && $_POST['trade_satellite'] == 'Automatic' && !$mailsent) echo "selected"; ?>>Automatic</option>
													<option value="In-Motion" <?php if ($_POST && $_POST['trade_satellite'] == 'In-Motion' && !$mailsent) echo "selected"; ?>>In-Motion</option>
													<option value="None" <?php if ($_POST && $_POST['trade_satellite'] == 'None' && !$mailsent) echo "selected"; ?>>None</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_wheels" name="trade_wheels">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Aluminum Wheels</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_wheels'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_wheels'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_nav" name="trade_nav">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Navigation</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_nav'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_nav'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_camera" name="trade_camera">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Back-Up Camera</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_camera'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_camera'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_hydrohot" name="trade_hydrohot">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Aqua Hot</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_hydrohot'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_hydrohot'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_tile" name="trade_tile">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Ceramic Tile</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_tile'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_tile'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns">
										</div>
										<div class="three columns">
										</div>
									</div>
								</fieldset>
								<fieldset>
								<legend>Condition of Coach</legend>
								
									<div class="row">	
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_carpet" name="trade_con_carpet">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Carpet and Flooring</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_carpet'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_carpet'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_carpet'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_carpet'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_carpet'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_sofa" name="trade_con_sofa">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Sofas and Chairs</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_sofa'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_sofa'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_sofa'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_sofa'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_sofa'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trace_con_dinette" name="trace_con_dinette">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Dinette</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trace_con_dinette'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trace_con_dinette'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trace_con_dinette'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trace_con_dinette'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trace_con_dinette'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_cabinets" name="trade_con_cabinets">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Cabinets</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_cabinets'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_cabinets'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_cabinets'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_cabinets'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_cabinets'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
									</div>
										
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_refer" name="trade_con_refer">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Refrigerator</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_refer'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_refer'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_refer'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_refer'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_refer'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
											
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_over" name="trade_con_over">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Stove/Oven</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_over'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_over'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_over'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_over'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_over'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_bed_spread" name="trade_con_bed_spread">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Bed Spread</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_bed_spread'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_bed_spread'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_bed_spread'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_bed_spread'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_bed_spread'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
										
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_decals" name="trade_con_decals">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Exterior Decals and Stripes</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_decals'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_decals'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_decals'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_decals'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_decals'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_seats" name="trade_con_seats">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Pilot and Copilot Seats</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_seats'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_seats'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_seats'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_seats'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_seats'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_liner" name="trade_con_liner">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Head Liner</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_liner'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_liner'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_liner'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_liner'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_liner'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_windshield_damage" name="trade_windshield_damage">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Windshield damage?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_windshield_damage'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_windshield_damage'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_window_fogged" name="trade_window_fogged">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Fogged windows?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_window_fogged'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_window_fogged'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_batteries" name="trade_batteries">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Original Batteries?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_batteries'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_batteries'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_ac_condition" name="trade_ac_condition">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Coach A/C's cold?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_ac_condition'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_ac_condition'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_dash_ac" name="trade_dash_ac">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Dash A/C's cold?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_dash_ac'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_dash_ac'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_exhaust" name="trade_exhaust">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Exhaust leaks?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_exhaust'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_exhaust'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
									</div>
									
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_con_paint" name="trade_con_paint">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Exterior Paint</option>
													<option value="Excellent" <?php if ($_POST && $_POST['trade_con_paint'] == 'Excellent' && !$mailsent) echo "selected"; ?>>Excellent</option>
													<option value="Good" <?php if ($_POST && $_POST['trade_con_paint'] == 'Good' && !$mailsent) echo "selected"; ?>>Good</option>
													<option value="Fair" <?php if ($_POST && $_POST['trade_con_paint'] == 'Fair' && !$mailsent) echo "selected"; ?>>Fair</option>
													<option value="Poor" <?php if ($_POST && $_POST['trade_con_paint'] == 'Poor' && !$mailsent) echo "selected"; ?>>Poor</option>
													<option value="N/A" <?php if ($_POST && $_POST['trade_con_paint'] == 'N/A' && !$mailsent) echo "selected"; ?>>N/A</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_missing" name="trade_missing">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Anything Missing?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_missing'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_missing'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_ext_damage" name="trade_ext_damage">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Exterior Damage?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_ext_damage'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_ext_damage'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="three columns field">
											<div class="picker">
												<select id="trade_int_damage" name="trade_int_damage">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Interior Damage?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_int_damage'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_int_damage'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_window_damage" name="trade_window_damage">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Window Damage?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_window_damage'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_window_damage'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_water_damage" name="trade_water_damage">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Water Damage?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_water_damage'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_water_damage'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_wall_delamination" name="trade_wall_delamination">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Wall Delamination?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_wall_delamination'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_wall_delamination'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_everything_working" name="trade_everything_working">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Everything Working?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_everything_working'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_everything_working'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
									</div>
									
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_everything_original" name="trade_everything_original">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Everything Original?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_everything_original'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_everything_original'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_org_owner" name="trade_org_owner">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Original Owner?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_org_owner'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_org_owner'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_smoked" name="trade_smoked">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Smoked In?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_smoked'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_smoked'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_lived_in" name="trade_lived_in">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Lived In?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_lived_in'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_lived_in'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
									</div>
									
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_pets" name="trade_pets">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Pet damage?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_pets'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_pets'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_manuals" name="trade_manuals">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Owner's Manuals?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_manuals'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_manuals'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_bed_spread" name="trade_bed_spread">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Original Bedding?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_bed_spread'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_bed_spread'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_remotes" name="trade_remotes">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>All remote controls?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_remotes'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_remotes'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
									</div>
									
									<div class="row">
										<div class="three columns field">
											<div class="picker">
												<select id="trade_org_tires" name="trade_org_tires">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Original Tires?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_org_tires'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_org_tires'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_tires_match" name="trade_tires_match">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Tires Match?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_tires_match'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_tires_match'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_tires_rotted" name="trade_tires_rotted">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Tires dry rotted?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_tires_rotted'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_tires_rotted'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
										<div class="three columns field">
											<div class="picker">
												<select id="trade_tires_wearing" name="trade_tires_wearing">
													<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Tires wearing even?</option>
													<option value="Yes" <?php if ($_POST && $_POST['trade_tires_wearing'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['trade_tires_wearing'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>	
									</div>
									<div class="row">
										<div class="twelve columns field">
											<label for="trade_further_info">Explanation of any question you answered <em>yes</em> to above:</label>
											<textarea class="input textarea" placeholder="" name="trade_further_info" id="trade_further_info" ></textarea>
										</div>	
									</div>
								</fieldset>
								
								<div class="row">
									<div class="large six columns">
										<fieldset>
										<legend>Additional Information</legend>
											
											<div class="row">
											
												<div class="eight columns field">
													<div class="picker">
														<select id="trade_owe" name="trade_owe">
															<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>Owe anything on the coach?</option>
															<option value="Yes" <?php if ($_POST && $_POST['trade_owe'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
															<option value="No" <?php if ($_POST && $_POST['trade_owe'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
														</select>
													</div>
												</div>
										
												<div class="four columns field">
													<input class=" text input" id="trade_amount_owed" name="trade_amount_owed" placeholder="Estimated Payoff" type="text" />
												</div>
												
										    </div>
										    <div class="row">
											    
											    <div class="field">
													<div class="picker">
														<select id="trade_bid" name="trade_bid">
															<option value="Did Not Answer" disabled <?php if (!$_POST) echo "selected"; ?>>What type of value where you looking for?</option>
															<option value="Trade Value" <?php if ($_POST && $_POST['trade_bid'] == 'Trade Value' && !$mailsent) echo "selected"; ?>>Trade Value</option>
															<option value="Consignment" <?php if ($_POST && $_POST['trade_bid'] == 'Consignment' && !$mailsent) echo "selected"; ?>>Consignment</option>
															<option value="Buy Bid" <?php if ($_POST && $_POST['trade_bid'] == 'Buy Bid' && !$mailsent) echo "selected"; ?>>Buy Bid</option>
														</select>
													</div>
											    </div>
										    </div>
											    
										    <div class="row">
										    	<div class="field">
										    		<label for="trade_interest">Description or stock number of the RV you are interested in...</label>
													<textarea class="input textarea" name="trade_interest" id="trade_interest"></textarea>
										    	</div>
										    </div>
											   
										</fieldset>
									</div>
									
									<div class="six columns">
										<fieldset>
										<legend>Your Contact Information</legend>
											<ul>
						             			<li>
													<div class="field <?php if ($missing && in_array('trade_first_name', $missing)) { ?> danger <?php } ?> one-half">
														<input class=" text input" type="text" name="trade_first_name" id="trade_first_name" placeholder="First Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_first_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
													</div>
													<div class="field  <?php if ($missing && in_array('trade_last_name', $missing)) { ?> danger <?php } ?> one-half">
														<input class=" text input"  type="text" name="trade_last_name" id="trade_last_name" placeholder="Your last Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_last_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
													</div>
												</li>
												<li>
													<div class="field <?php if ($missing && in_array('email', $missing)) { ?> danger <?php } ?> one-half">
									                    <input class="input" type="email" name="email" id="email" placeholder="Email address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
													</div>
													<div class="field <?php if ($missing && in_array('trade_phone', $missing)) { ?> danger <?php } ?> one-half">
									                    <input class="input" type="phone" name="trade_phone" id="trade_phone" placeholder="Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['trade_phone'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
													</div>
												</li>
												<li class="field">
								                    <input class="input" type="text" name="salesman" id="salesman" placeholder="Salesperson" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['salesman'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
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
											</ul>
										</fieldset>
									</div>
									
									<div class="row">
										<button name="send" id="send" type="submit" class="blue-btn">Submit</button>
									</div>
									
								</div>
							</div>
				    	</div>
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
