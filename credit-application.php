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
    
    if ($_POST['application_unit'] == 'Motorized') {
	    $to = 'dnewland@vogtrv.com';
    } elseif ($_POST['application_unit'] == 'Towable') {
	    $to = 'avogt@vogtrv.com';
    } else {
	    $to = 'mahlon.miller@mac.com';
    }
    
    $subject = 'Credit Application';
    
    if ($_POST['application_type'] == 'Joint Credit') {
    
    $expected = array('stock_number', 'location', 'application_type','application_unit','application_salesman','first_name','last_name', 'dependents', 'date_of_birth', 'social_security', 'marital_status', 'driver_license', 'driver_license_state', 'citizenship', 'home_street_address', 'time_at_address_years', 'time_at_address_months', 'home_city', 'home_state', 'home_zip', 'email', 'home_phone', 'cell_phone', 'employer', 'time_at_employer_years','time_at_employer_months','employer_address_street', 'employer_address_city', 'employer_address_state', 'employer_address_zip', 'position', 'employer_phone', 'income', 'pay_period', 'relative_name', 'relative_phone', 'relative_address_street', 'relative_address_city', 'relative_address_state', 'relative_address_zip','additional_income_source', 'additional_income_amount', 'resident_status', 'mortgage_company', 'mortgage_payment','first_name_2', 'last_name_2', 'dependents_2', 'date_of_birth_2', 'social_security_2', 'marital_status_2', 'driver_license_2', 'driver_license_state_2', 'citizenship_2', 'home_street_address_2', 'time_at_address_years_2','time_at_address_months_2', 'home_city_2', 'home_state_2', 'home_zip_2', 'email_2','home_phone_2', 'cell_phone_2', 'employer_2', 'time_at_employer_years_2','time_at_employer_months_2','employer_address_street_2', 'employer_address_city_2', 'employer_address_state_2', 'employer_address_zip_2', 'position_2', 'employer_phone_2', 'income_2', 'pay_period_2', 'relative_name_2', 'relative_phone_2', 'relative_address_street_2', 'relative_address_city_2', 'relative_address_state_2', 'relative_address_zip_2','additional_income_source_2', 'additional_income_amount_2', 'resident_status_2', 'mortgage_company_2', 'mortgage_payment_2');
    
     $required = array('application_type','application_unit','application_salesman','first_name', 'last_name', 'date_of_birth', 'social_security', 'marital_status', 'driver_license', 'driver_license_state', 'citizenship', 'home_street_address', 'time_at_address_years', 'time_at_address_months', 'home_city', 'home_state', 'home_zip', 'email', 'home_phone', 'cell_phone', 'employer', 'time_at_employer_years','time_at_employer_months','employer_address_street', 'employer_address_city', 'employer_address_state', 'employer_address_zip', 'position', 'employer_phone', 'income', 'pay_period', 'relative_name', 'relative_phone', 'relative_address_street', 'relative_address_city', 'relative_address_state', 'relative_address_zip', 'resident_status', 'mortgage_company', 'mortgage_payment','first_name_2', 'last_name_2', 'date_of_birth_2', 'social_security_2', 'marital_status_2', 'driver_license_2', 'driver_license_state_2', 'citizenship_2', 'home_street_address_2', 'time_at_address_years_2','time_at_address_months_2', 'home_city_2', 'home_state_2', 'home_zip_2', 'email_2','home_phone_2', 'cell_phone_2', 'employer_2', 'time_at_employer_years_2','time_at_employer_months_2','employer_address_street_2', 'employer_address_city_2', 'employer_address_state_2', 'employer_address_zip_2', 'position_2', 'employer_phone_2', 'income_2', 'pay_period_2', 'relative_name_2', 'relative_phone_2', 'relative_address_street_2', 'relative_address_city_2', 'relative_address_state_2', 'relative_address_zip_2', 'resident_status_2', 'mortgage_company_2', 'mortgage_payment_2');;
    
    } else {
	    
	    $expected = array('stock_number', 'location', 'application_type','application_unit','application_salesman','first_name', 'last_name', 'dependents', 'date_of_birth', 'social_security', 'marital_status', 'driver_license', 'driver_license_state', 'citizenship', 'home_street_address', 'time_at_address_years', 'time_at_address_months', 'home_city', 'home_state', 'home_zip', 'email', 'home_phone', 'cell_phone', 'employer', 'time_at_employer_years','time_at_employer_months','employer_address_street', 'employer_address_city', 'employer_address_state', 'employer_address_zip', 'position', 'employer_phone', 'income', 'pay_period', 'relative_name', 'relative_phone', 'relative_address_street', 'relative_address_city', 'relative_address_state', 'relative_address_zip','additional_income_source', 'additional_income_amount', 'resident_status', 'mortgage_company', 'mortgage_payment');
    
        $required = array('application_type','application_unit','application_salesman','first_name', 'last_name', 'date_of_birth', 'social_security', 'marital_status', 'driver_license', 'driver_license_state', 'citizenship', 'home_street_address', 'time_at_address_years', 'time_at_address_months', 'home_city', 'home_state', 'home_zip', 'email', 'home_phone', 'cell_phone', 'employer', 'time_at_employer_years','time_at_employer_months','employer_address_street', 'employer_address_city', 'employer_address_state', 'employer_address_zip', 'position', 'employer_phone', 'income', 'pay_period', 'relative_name', 'relative_phone', 'relative_address_street', 'relative_address_city', 'relative_address_state', 'relative_address_zip', 'resident_status', 'mortgage_company', 'mortgage_payment');
	    
    }
       
    $previous_address = array('previous_address_street', 'time_at_previous_address_years','time_at_previous_address_months', 'previous_address_city', 'previous_address_state', 'previous_address_zip');
    
    $previous_address_2 = array('previous_address_street_2', 'time_at_previous_address_years_2','time_at_previous_address_months_2', 'previous_address_city_2', 'previous_address_state_2', 'previous_address_zip_2');
    
    $previous_employer = array( 'previous_employer', 'time_at_previous_employer_years', 'time_at_previous_employer_months' ,'previous_employer_address_street', 'previous_employer_address_city',  'previous_employer_address_state', 'previous_employer_address_zip');
    
    $previous_employer_2 = array('previous_employer_2', 'time_at_previous_employer_years_2', 'time_at_previous_employer_months_2', 'previous_employer_address_street_2', 'previous_employer_address_city_2',  'previous_employer_address_state_2', 'previous_employer_address_zip_2');
    
    $citizenship = array('country');
    
    $citizenship_2 = array('country_2');
    
     if ($_POST['time_at_address_years'] < 5) {
    
		$expected = array_merge($expected, $previous_address);
		$required = array_merge($required, $previous_address);
	    
    } 
    
    if ($_POST['time_at_address_years'] < 5 && $_POST['application_type'] == 'Joint Credit') {
    
		$expected = array_merge($expected, $previous_address_2);
		$required = array_merge($required, $previous_address_2);
	    
    } 
    
   if ($_POST['time_at_employer_years'] < 5) {
    
		$expected = array_merge($expected, $previous_employer);
		$required = array_merge($required, $previous_employer);
	    
    } 
    
    if ($_POST['time_at_employer_years_2'] < 5 && $_POST['application_type'] == 'Joint Credit') {
    
		$expected = array_merge($expected, $previous_employer_2);
		$required = array_merge($required, $previous_employer_2);
	    
    }     
    
    if ($_POST['citizenship'] == 'No') {
    
		$expected = array_merge($expected, $citizenship);
		$required = array_merge($required, $citizenship);
	    
    } 
    
    if ($_POST['citizenship_2']  == 'No' && $_POST['application_type'] == 'Joint Credit') {
    
		$expected = array_merge($expected, $citizenship_2);
		$required = array_merge($required, $citizenship_2);
	    
    }         
    // create additional headers
    $headers = "From: Online Credit Application <vogtrv@vogtrv.com>\r\n";
	    
	require('includes/processmail_tbl.inc.php');
   
}
$state_list = array('AL'=>"Alabama",
                'AK'=>"Alaska", 
                'AZ'=>"Arizona", 
                'AR'=>"Arkansas", 
                'CA'=>"California", 
                'CO'=>"Colorado", 
                'CT'=>"Connecticut", 
                'DE'=>"Delaware", 
                'DC'=>"District Of Columbia", 
                'FL'=>"Florida", 
                'GA'=>"Georgia", 
                'HI'=>"Hawaii", 
                'ID'=>"Idaho", 
                'IL'=>"Illinois", 
                'IN'=>"Indiana", 
                'IA'=>"Iowa", 
                'KS'=>"Kansas", 
                'KY'=>"Kentucky", 
                'LA'=>"Louisiana", 
                'ME'=>"Maine", 
                'MD'=>"Maryland", 
                'MA'=>"Massachusetts", 
                'MI'=>"Michigan", 
                'MN'=>"Minnesota", 
                'MS'=>"Mississippi", 
                'MO'=>"Missouri", 
                'MT'=>"Montana",
                'NE'=>"Nebraska",
                'NV'=>"Nevada",
                'NH'=>"New Hampshire",
                'NJ'=>"New Jersey",
                'NM'=>"New Mexico",
                'NY'=>"New York",
                'NC'=>"North Carolina",
                'ND'=>"North Dakota",
                'OH'=>"Ohio", 
                'OK'=>"Oklahoma", 
                'OR'=>"Oregon", 
                'PA'=>"Pennsylvania", 
                'RI'=>"Rhode Island", 
                'SC'=>"South Carolina", 
                'SD'=>"South Dakota",
                'TN'=>"Tennessee", 
                'TX'=>"Texas", 
                'UT'=>"Utah", 
                'VT'=>"Vermont", 
                'VA'=>"Virginia", 
                'WA'=>"Washington", 
                'WV'=>"West Virginia", 
                'WI'=>"Wisconsin", 
                'WY'=>"Wyoming");
                
               

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
			<div class="nine columns">
				<h2>Credit Application</h2>
			</div>
			<div class="three columns">
				<a class="blue-btn" href="https://www.vogtrv.com/" target="_blank">Return Home</a>
			</div>
		</div>
	</div>
		
	<div class="full-width">
		
   <!--      <div class="row">
            <pre>
                <?php print_r($_POST); ?>
            </pre>
        </div>
 -->
    	<div class="row">
        
        	<form id="credit-application" class="credit-application" method="post" action="credit-application.php">
        		<input type="hidden" name="stock_number" value="<?php echo $_GET['stocknum']; ?>">
        		<input type="hidden" name="location" value="<?php echo  $_GET['location']; ?>">
        		
        		<?php if (isset($_POST['send'])) { ?>
                        
                     <div class="row"> 
                        
                    <?php if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
                    
                        <p class="danger alert">Sorry, your message could not be sent at this time.</p>
                    
                    <?php } elseif (($missing || $errors) && isset($_POST['send'])) { ?>
                    
                        <p class="danger alert">Please fix the item(s) indicated.</p>
                        
                    <?php } elseif ($mailsent)  { ?>
                    
                        <p class="success alert">Thank you for your inquiry, we will contact you shortly.</p>
                        
                    <?php } ?>  
                    
                     </div>

                <?php } ?>
        		<div class="row">
        			<div class="two columns">
            				<div class="field ">
								<div class="picker">
									<select id="application_type" name="application_type">
										<option value="#" disabled <?php if (!$_POST || $_POST['application_type'] == '') echo "selected"; ?>>Application Type</option>
										<option value="Individual Credit" <?php if ($_POST && $_POST['application_type'] == 'Individual Credit' && !$mailsent) echo "selected"; ?>>Individual Credit</option>
										<option value="Joint Credit" <?php if ($_POST && $_POST['application_type'] == 'Joint Credit' && !$mailsent) echo "selected"; ?>>Joint Credit with the applicant's spouse</option>
									</select>
								</div>
							</div>
            			</div>
            			<div class="two columns">
            				<div class="field">
								<div class="picker"> 
									<select id="application_unit" name="application_unit">
										<option value="Unit Type" disabled <?php if (!$_POST || $_POST['application_unit'] == '') echo "selected"; ?>>Unit Type</option>
										<option value="Motorized" <?php if ($_POST && $_POST['application_unit'] == 'Motorized' && !$mailsent) echo "selected"; ?>>Motorized</option>
										<option value="Towable" <?php if ($_POST && $_POST['application_unit'] == 'Towable' && !$mailsent) echo "selected"; ?>>Towable</option>
									</select>
								</div>
							</div>
            			</div>
                        <div class="two columns">
                            <div class="field">
                                <div class="picker">
                                    <select id="application_salesman" name="application_salesman">
                                        <option value="#" disabled <?php if (!$_POST || $_POST['application_salesman'] == '') echo "selected"; ?>>Salesperson</option>
                                        <option value="Colby" <?php if ($_POST && $_POST['application_salesman'] == 'Colby' && !$mailsent) echo "selected"; ?>>Colby Cannon</option>
                                        <option value="Lupe" <?php if ($_POST && $_POST['application_salesman'] == 'Lupe' && !$mailsent) echo "selected"; ?>>Lupe Frausto</option>
                                        <option value="Race" <?php if ($_POST && $_POST['application_salesman'] == 'Race' && !$mailsent) echo "selected"; ?>>Race Harrell</option>
                                        <option value="Dennis" <?php if ($_POST && $_POST['application_salesman'] == 'Dennis' && !$mailsent) echo "selected"; ?>>Dennis Moore</option>
                                        <option value="Justin" <?php if ($_POST && $_POST['application_salesman'] == 'Justin' && !$mailsent) echo "selected"; ?>>Justin Nasiff</option>
                                        <option value="JJ" <?php if ($_POST && $_POST['application_salesman'] == 'JJ' && !$mailsent) echo "selected"; ?>>JJ Neves</option>
                                        <option value="Greg" <?php if ($_POST && $_POST['application_salesman'] == 'Greg' && !$mailsent) echo "selected"; ?>>Greg Robertson</option>
                                        <option value="Not Sure" <?php if ($_POST && $_POST['application_salesman'] == 'Not Sure' && !$mailsent) echo "selected"; ?>>Not Sure</option>
                                    </select>
                                </div>
                            </div>
                        </div>
        		</div>
						
				<div class="row">
					<!-- Applicant One -->
						
						<div  class="six columns">
							<fieldset>
								<legend>Applicant One</legend>
								<ul>
			             			<li>
										<div class="field <?php if ($missing && in_array('first_name', $missing)) { ?> danger <?php } ?> one-half">
											<input class=" text input" type="text" name="first_name" id="first_name" placeholder="First and Middle Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['first_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('last_name', $missing)) { ?> danger <?php } ?> one-half">
											<input class=" text input"  type="text" name="last_name" id="last_name" placeholder="Your last Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['last_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('date_of_birth', $missing)) { ?> danger <?php } ?> one-third">
											<input class=" text input" type="text" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['date_of_birth'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('social_security', $missing)) { ?> danger <?php } ?> one-third">
											<input class=" text input"  type="text" name="social_security" id="social_security" placeholder="Social Security Number" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['social_security'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('marital_status', $missing)) { ?> danger <?php } ?> one-third">
											<div class="picker">
												<select id="marital_status" name="marital_status">
													<option value="#" disabled <?php if (!$_POST || $_POST['marital_status'] == '') echo "selected"; ?>>Marital Status</option>
													<option value="Married" <?php if ($_POST && $_POST['marital_status'] == 'Married' && !$mailsent) echo "selected"; ?>>Married</option>
													<option value="Single" <?php if ($_POST && $_POST['marital_status'] == 'Single' && !$mailsent) echo "selected"; ?>>Single</option>
												</select>
											</div>
										</div>
									</li>
									<li>
										<div class="field  <?php if ($missing && in_array('driver_license', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="driver_license" id="driver_license" placeholder="Driver's License" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['driver_license'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('driver_license_state', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker">
												<select id="driver_license_state" name="driver_license_state">
													<option value="#" disabled <?php if (!$_POST || $_POST['driver_license_state'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['driver_license_state'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field one-fourth">
				                    		<input class="input" type="text" name="dependents" id="dependents" placeholder="Dependents" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['dependents'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field  <?php if ($missing && in_array('citizenship', $missing)) { ?> danger <?php } ?> one-third">
											<div class="picker">
												<select id="citizenship" name="citizenship">
													<option value="#" disabled <?php if (!$_POST || $_POST['citizenship'] == '') echo "selected"; ?>>US Citizen</option>
													<option value="Yes" <?php if ($_POST && $_POST['citizenship'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['citizenship'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="field  <?php if ($missing && in_array('country', $missing)) { ?> danger <?php } ?> two-third">
											<input class=" text input"  type="text" name="country" id="country" placeholder="Country of Citizenship" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['country'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('email', $missing)) { ?> danger <?php } ?> one-half">
						                    <input class="input" type="email" name="email" id="email" placeholder="Email address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('home_phone', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="phone" name="home_phone" id="home_phone" placeholder="Home Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['home_phone'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('cell_phone', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="phone" name="cell_phone" id="cell_phone" placeholder="Cell Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['cell_phone'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>Current Address</li>
									<li>
										<div class="field <?php if ($missing && in_array('home_street_address', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="home_street_address" id="home_street_address" placeholder="Street Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['home_street_address'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_address_years', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" name="time_at_address_years" id="time_at_address_years" placeholder="Years" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_address_years'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_address_months', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" max="12" name="time_at_address_months" id="time_at_address_months" placeholder="Months" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_address_months'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('home_city', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="home_city" id="home_city" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['home_city'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('home_state', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker ">
												<select id="home_state" name="home_state">
													<option value="#" disabled <?php if (!$_POST || $_POST['home_state'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['home_state'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('home_zip', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="home_zip" id="home_zip" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['home_zip'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li>
										<div class="field  <?php if ($missing && in_array('resident_status', $missing)) { ?> danger <?php } ?> one-third">
											<div class="picker">
												<select id="resident_status" name="resident_status">
													<option value="#" disabled <?php if (!$_POST || $_POST['resident_status'] == '') echo "selected"; ?>>Resident Status</option>
													<option value="Mortgage" <?php if ($_POST && $_POST['resident_status'] == 'Mortgage' && !$mailsent) echo "selected"; ?>>Mortgage</option>
													<option value="Rent" <?php if ($_POST && $_POST['resident_status'] == 'Rent' && !$mailsent) echo "selected"; ?>>Rent</option>
													<option value="Family" <?php if ($_POST && $_POST['resident_status'] == 'Family' && !$mailsent) echo "selected"; ?>>Family</option>
													<option value="Own Outright" <?php if ($_POST && $_POST['resident_status'] == 'Own Outright' && !$mailsent) echo "selected"; ?>>Own Outright</option>
													<option value="Military" <?php if ($_POST && $_POST['resident_status'] == 'Military' && !$mailsent) echo "selected"; ?>>Military</option>
													<option value="Other" <?php if ($_POST && $_POST['resident_status'] == 'Other' && !$mailsent) echo "selected"; ?>>Other</option>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('mortgage_company', $missing)) { ?> danger <?php } ?> one-third">
				                    		<input class="input" type="text" name="mortgage_company" id="mortgage_company" placeholder="Mortgage Company" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['mortgage_company'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('mortgage_payment', $missing)) { ?> danger <?php } ?> one-third">
				                    		<input class="input" type="text" name="mortgage_payment" id="mortgage_payment" placeholder="Mortgage/Rent" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['mortgage_payment'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										
									</li>
									
									<li>
										<p>Previous Address</p>
										<p class="small">Only if time at your current address is less than 5 years</p>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('previous_address_street', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="previous_address_street" id="previous_address_street" placeholder="Street Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_address_street'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_previous_address_years', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" name="time_at_previous_address_years" id="time_at_previous_address_years" placeholder="Years" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_previous_address_years'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_previous_address_months', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" max="12" name="time_at_previous_address_months" id="time_at_previous_address_months" placeholder="Months" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_previous_address_months'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('previous_address_city', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="previous_address_city" id="previous_address_city" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_address_city'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('previous_address_state', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker">
												<select id="previous_address_state" name="previous_address_state">
													<option value="#" disabled <?php if (!$_POST || $_POST['previous_address_state'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['previous_address_state'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('previous_address_zip', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="previous_address_zip" id="previous_address_zip" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_address_zip'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li>Current Employer</li>
									<li>
										<div class="field <?php if ($missing && in_array('employer', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="employer" id="employer" placeholder="Employer Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_employer_years', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" name="time_at_employer_years" id="time_at_employer_years" placeholder="Years" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_employer_years'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_employer_months', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" max="12" name="time_at_employer_months" id="time_at_employer_months" placeholder="Months" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_employer_months'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li class="field <?php if ($missing && in_array('employer_address_street', $missing)) { ?> danger <?php } ?>">
				                    		<input class="input" type="text" name="employer_address_street" id="employer_address_street" placeholder="Employer Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_address_street'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('employer_address_city', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="employer_address_city" id="employer_address_city" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_address_city'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('employer_address_state', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker ">
												<select id="employer_address_state" name="employer_address_state">
													<option value="#" disabled <?php if (!$_POST || $_POST['employer_address_state'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['employer_address_state'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('employer_address_zip', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="employer_address_zip" id="employer_address_zip" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_address_zip'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('employer_phone', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="phone" name="employer_phone" id="employer_phone" placeholder="Business Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_phone'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('position', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="position" id="position" placeholder="Position/Title" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['position'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('income', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="income" id="income" placeholder="Gross  Income" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['income'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('pay_period', $missing)) { ?> danger <?php } ?> one-half">
											<div class="picker">
												<select id="pay_period" name="pay_period">
													<option value="#" disabled <?php if (!$_POST || $_POST['pay_period'] == '') echo "selected"; ?>>Pay Period</option>
													<option value="Yearly" <?php if ($_POST && $_POST['pay_period'] == 'Yearly' && !$mailsent) echo "selected"; ?>>Yearly</option>
													<option value="Monthly" <?php if ($_POST && $_POST['pay_period'] == 'Monthly' && !$mailsent) echo "selected"; ?>>Monthly</option>
												</select>
											</div>
										</div>
									</li>
									
									<li>
										<p>Previous Employer</p>
										<p class="small">Only if time at your current employer is less than 5 years</p>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('previous_employer', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="previous_employer" id="previous_employer" placeholder="Employer Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_employer'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_previous_employer_years', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" name="time_at_previous_employer_years" id="time_at_previous_employer_years" placeholder="Years" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_previous_employer_years'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_previous_employer_months', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" max="12" name="time_at_previous_employer_months" id="time_at_previous_employer_months" placeholder="Months" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_previous_employer_months'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li class="field <?php if ($missing && in_array('previous_employer_address_street', $missing)) { ?> danger <?php } ?>">
				                    		<input class="input" type="text" name="previous_employer_address_street" id="previous_employer_address_street" placeholder="Employer Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_employer_address_street'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('previous_employer_address_city', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="previous_employer_address_city" id="previous_employer_address_city" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_employer_address_city'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('previous_employer_address_state', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker ">
												<select id="previous_employer_address_state" name="previous_employer_address_state">
													<option value="#" disabled <?php if (!$_POST || $_POST['previous_employer_address_state'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['previous_employer_address_state'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('previous_employer_address_zip', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="previous_employer_address_zip" id="previous_employer_address_zip" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_employer_address_zip'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li>Nearest Relative Not Living With You</li>
									
									<li>
										<div class="field <?php if ($missing && in_array('relative_name', $missing)) { ?> danger <?php } ?> two-third">
				                    		<input class="input" type="text" name="relative_name" id="relative_name" placeholder="First and Last Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_name'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('relative_phone', $missing)) { ?> danger <?php } ?> one-third">
				                    		<input class="input" type="phone" name="relative_phone" id="relative_phone" placeholder="Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_phone'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li class="field <?php if ($missing && in_array('relative_address_street', $missing)) { ?> danger <?php } ?>">
				                    		<input class="input" type="text" name="relative_address_street" id="relative_address_street" placeholder="Stree Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_address_street'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('relative_address_city', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="relative_address_city" id="relative_address_city" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_address_city'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('relative_address_state', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker ">
												<select id="relative_address_state" name="relative_address_state">
													<option value="#" disabled <?php if (!$_POST || $_POST['relative_address_state'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['relative_address_state'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('relative_address_zip', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="relative_address_zip" id="relative_address_zip" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_address_zip'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<p>Additional Income</p>
										<p class="small">You do not have to reveal alimony, child support or separate maintenance income unless you wish to have them considered for approving your application.</p>
									<li>
										<div class="field <?php if ($missing && in_array('additional_income_source', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="additional_income_source" id="additional_income_source" placeholder="Source" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['additional_income_source'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('additional_income_amount', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="additional_income_amount" id="additional_income_amount" placeholder="Amount" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['additional_income_amount'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
			             		</ul>
							</fieldset>
						</div>
						
						<!-- End Applicant One -->
						
						<!-- Applicant Two -->
						
						<div  class="six columns">
							<fieldset>
								<legend>Applicant Two</legend>
								<ul>
			             			<li>
										<div class="field <?php if ($missing && in_array('first_name_2', $missing)) { ?> danger <?php } ?> one-half">
											<input class=" text input" type="text" name="first_name_2" id="first_name_2" placeholder="First and Middle Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['first_name_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('last_name_2', $missing)) { ?> danger <?php } ?> one-half">
											<input class=" text input"  type="text" name="last_name_2" id="last_name_2" placeholder="Your last Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['last_name_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('date_of_birth_2', $missing)) { ?> danger <?php } ?> one-third">
											<input class=" text input" type="text" name="date_of_birth_2" id="date_of_birth_2" placeholder="Date of Birth" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['date_of_birth_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('social_security_2', $missing)) { ?> danger <?php } ?> one-third">
											<input class=" text input"  type="text" name="social_security_2" id="social_security_2" placeholder="Social Security Number" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['social_security_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('marital_status_2', $missing)) { ?> danger <?php } ?> one-third">
											<div class="picker">
												<select id="marital_status" name="marital_status_2">
													<option value="#" disabled <?php if (!$_POST) echo "selected"; ?>>Marital Status</option>
													<option value="Married" <?php if ($_POST && $_POST['marital_status_2'] == 'Married' && !$mailsent) echo "selected"; ?>>Married</option>
													<option value="Single" <?php if ($_POST && $_POST['marital_status_2'] == 'Single' && !$mailsent) echo "selected"; ?>>Single</option>
												</select>
											</div>
										</div>
									</li>
									<li>
										<div class="field  <?php if ($missing && in_array('driver_license_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="driver_license_2" id="driver_license" placeholder="Driver's License" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['driver_license'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('driver_license_state_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker">
												<select id="driver_license_state" name="driver_license_state_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['driver_license_state_2'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['driver_license_state_2'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field one-fourth">
				                    		<input class="input" type="text" name="dependents_2" id="dependents_2" placeholder="Dependents" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['dependents_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field  <?php if ($missing && in_array('citizenship_2', $missing)) { ?> danger <?php } ?> one-third">
											<div class="picker">
												<select id="citizenship" name="citizenship_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['citizenship_2'] == '') echo "selected"; ?>>US Citizen</option>
													<option value="Yes" <?php if ($_POST && $_POST['citizenship_2'] == 'Yes' && !$mailsent) echo "selected"; ?>>Yes</option>
													<option value="No" <?php if ($_POST && $_POST['citizenship_2'] == 'No' && !$mailsent) echo "selected"; ?>>No</option>
												</select>
											</div>
										</div>
										<div class="field  <?php if ($missing && in_array('country_2', $missing)) { ?> danger <?php } ?> two-third">
											<input class=" text input"  type="text" name="country_2" id="country" placeholder="Country of Citizenship" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['country'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('email_2', $missing)) { ?> danger <?php } ?> one-half">
						                    <input class="input" type="email" name="email_2" id="email_2" placeholder="Email address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['email_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('home_phone_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="phone" name="home_phone_2" id="home_phone_2" placeholder="Home Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['home_phone_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('cell_phone_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="phone" name="cell_phone_2" id="cell_phone_2" placeholder="Cell Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['cell_phone_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>Current Address</li>
									<li>
										<div class="field <?php if ($missing && in_array('home_street_address_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="home_street_address_2" id="home_street_address_2" placeholder="Street Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['home_street_address_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_address_years_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" name="time_at_address_years_2" id="time_at_address_years_2" placeholder="Years" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_address_years_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_address_months_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" max="12" name="time_at_address_months_2" id="time_at_address_months_2" placeholder="Months" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_address_months_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('home_city_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="home_city_2" id="home_city_2" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['home_city_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('home_state_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker ">
												<select id="home_state_2" name="home_state_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['home_state_2'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['home_state_2'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('home_zip_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="home_zip_2" id="home_zip" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['home_zip_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li>
										<div class="field  <?php if ($missing && in_array('resident_status_2', $missing)) { ?> danger <?php } ?> one-third">
											<div class="picker">
												<select id="resident_status" name="resident_status_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['resident_status_2'] == '') echo "selected"; ?>>Resident Status</option>
													<option value="Mortgage" <?php if ($_POST && $_POST['resident_status_2'] == 'Mortgage' && !$mailsent) echo "selected"; ?>>Mortgage</option>
													<option value="Rent" <?php if ($_POST && $_POST['resident_status_2'] == 'Rent' && !$mailsent) echo "selected"; ?>>Rent</option>
													<option value="Family" <?php if ($_POST && $_POST['resident_status_2'] == 'Family' && !$mailsent) echo "selected"; ?>>Family</option>
													<option value="Own Outright" <?php if ($_POST && $_POST['resident_status_2'] == 'Own Outright' && !$mailsent) echo "selected"; ?>>Own Outright</option>
													<option value="Military" <?php if ($_POST && $_POST['resident_status_2'] == 'Military' && !$mailsent) echo "selected"; ?>>Military</option>
													<option value="Other" <?php if ($_POST && $_POST['resident_status_2'] == 'Other' && !$mailsent) echo "selected"; ?>>Other</option>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('mortgage_company_2', $missing)) { ?> danger <?php } ?> one-third">
				                    		<input class="input" type="text" name="mortgage_company_2" id="mortgage_company_2" placeholder="Mortgage Company" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['mortgage_company_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('mortgage_payment_2', $missing)) { ?> danger <?php } ?> one-third">
				                    		<input class="input" type="text" name="mortgage_payment_2" id="mortgage_payment_2" placeholder="Mortgage/Rent" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['mortgage_payment_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										
									</li>
									
									<li>
										<p>Previous Address</p>
										<p class="small">Only if time at your current address is less than 5 years</p>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('previous_address_street_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="previous_address_street_2" id="previous_address_street_2" placeholder="Street Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_address_street_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_previous_address_years_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" name="time_at_previous_address_years_2" id="time_at_previous_address_years_2" placeholder="Years" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_previous_address_years_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_previous_address_months_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" max="12" name="time_at_previous_address_months_2" id="time_at_previous_address_months_2" placeholder="Months" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_previous_address_months_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('previous_address_city_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="previous_address_city_2" id="previous_address_city_2" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_address_city_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('previous_address_state_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker">
												<select id="previous_address_state_2" name="previous_address_state_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['previous_employer_address_state_2'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['previous_address_state_2'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('previous_address_zip_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="previous_address_zip_2" id="previous_address_zip" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_address_zip_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li>Current Employer</li>
									<li>
										<div class="field <?php if ($missing && in_array('employer_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="employer_2" id="employer_2" placeholder="Employer Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_employer_years_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" name="time_at_employer_years_2" id="time_at_employer_years_2" placeholder="Years" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_employer_years_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_employer_months_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" max="12" name="time_at_employer_months_2" id="time_at_employer_months_2" placeholder="Months" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_employer_months_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li class="field <?php if ($missing && in_array('employer_address_street_2', $missing)) { ?> danger <?php } ?>">
				                    		<input class="input" type="text" name="employer_address_street_2" id="employer_address_street_2" placeholder="Employer Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_address_street_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('employer_address_city_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="employer_address_city_2" id="employer_address_city_2" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_address_city_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('employer_address_state_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker ">
												<select id="employer_address_state_2" name="employer_address_state_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['employer_address_state_2'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['employer_address_state_2'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('employer_address_zip_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="employer_address_zip_2" id="employer_address_zip" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_address_zip_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('employer_phone_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="phone" name="employer_phone_2" id="employer_phone_2" placeholder="Business Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['employer_phone_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('position_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="position_2" id="position_2" placeholder="Position/Title" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['position_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('income_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="income_2" id="income_2" placeholder="Gross  Income" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['income_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('pay_period_2', $missing)) { ?> danger <?php } ?> one-half">
											<div class="picker">
												<select id="pay_period_2" name="pay_period_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['pay_period_2'] == '') echo "selected"; ?>>Pay Period</option>
													<option value="Yearly" <?php if ($_POST && $_POST['pay_period_2'] == 'Yearly' && !$mailsent) echo "selected"; ?>>Yearly</option>
													<option value="Monthly" <?php if ($_POST && $_POST['pay_period_2'] == 'Monthly' && !$mailsent) echo "selected"; ?>>Monthly</option>
												</select>
											</div>
										</div>
									</li>
									
									<li>
										<p>Previous Employer</p>
										<p class="small">Only if time at your current employer is less than 5 years</p>
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('previous_employer_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="previous_employer_2" id="previous_employer" placeholder="Employer Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_employer'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_previous_employer_years_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" name="time_at_previous_employer_years_2" id="time_at_previous_employer_years_2" placeholder="Years" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_previous_employer_years_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('time_at_previous_employer_months_2', $missing)) { ?> danger <?php } ?> one-fourth">
						                    <input class="input" type="number" min="0" max="12" name="time_at_previous_employer_months_2" id="time_at_previous_employer_months_2" placeholder="Months" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['time_at_previous_employer_months_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li class="field <?php if ($missing && in_array('previous_employer_address_street_2', $missing)) { ?> danger <?php } ?>">
				                    		<input class="input" type="text" name="previous_employer_address_street_2" id="previous_employer_address_street_2" placeholder="Employer Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_employer_address_street_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('previous_employer_address_city_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="previous_employer_address_city_2" id="previous_employer_address_city_2" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_employer_address_city_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('previous_employer_address_state_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker ">
												<select id="previous_employer_address_state_2" name="previous_employer_address_state_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['previous_employer_address_state_2'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['previous_employer_address_state_2'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('previous_employer_address_zip_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="previous_employer_address_zip_2" id="previous_employer_address_zip_2" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['previous_employer_address_zip_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									
									<li>Nearest Relative Not Living With You</li>
									
									<li>
										<div class="field <?php if ($missing && in_array('relative_name_2', $missing)) { ?> danger <?php } ?> two-third">
				                    		<input class="input" type="text" name="relative_name_2" id="relative_name_2" placeholder="First and Last Name" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_name_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('relative_phone_2', $missing)) { ?> danger <?php } ?> one-third">
				                    		<input class="input" type="phone" name="relative_phone_2" id="relative_phone_2" placeholder="Phone" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_phone_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li class="field <?php if ($missing && in_array('relative_address_street_2', $missing)) { ?> danger <?php } ?>">
				                    		<input class="input" type="text" name="relative_address_street_2" id="relative_address_street_2" placeholder="Stree Address" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_address_street_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										
									</li>
									<li>
										<div class="field <?php if ($missing && in_array('relative_address_city_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="relative_address_city_2" id="relative_address_city_2" placeholder="City" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_address_city_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field  <?php if ($missing && in_array('relative_address_state_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<div class="picker ">
												<select id="relative_address_state_2" name="relative_address_state_2">
													<option value="#" disabled <?php if (!$_POST || $_POST['relative_address_state_2'] == '') echo "selected"; ?>>State</option>
													
													<?php 
														foreach ($state_list as $key => $value) {
														
															if ($_POST && $_POST['relative_address_state_2'] == $key && !$mailsent) {
																echo "<option value='$key' selected>$key</option>";
															} else {
																echo "<option value='$key'>$key</option>";
															}
															
														}
													?>
												</select>
											</div>
										</div>
										<div class="field <?php if ($missing && in_array('relative_address_zip_2', $missing)) { ?> danger <?php } ?> one-fourth">
				                    		<input class="input" type="text" name="relative_address_zip_2" id="relative_address_zip_2" placeholder="Zip code" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['relative_address_zip_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
									<li>
										<p>Additional Income</p>
										<p class="small">You do not have to reveal alimony, child support or separate maintenance income unless you wish to have them considered for approving your application.</p>
									<li>
										<div class="field <?php if ($missing && in_array('additional_income_source_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="additional_income_source_2" id="additional_income_source_2" placeholder="Source" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['additional_income_source_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
										<div class="field <?php if ($missing && in_array('additional_income_amount_2', $missing)) { ?> danger <?php } ?> one-half">
				                    		<input class="input" type="text" name="additional_income_amount_2" id="additional_income_amount_2" placeholder="Amount" <?php if ($missing || $errors) { echo 'value="' . htmlentities($_POST['additional_income_amount_2'], ENT_COMPAT, 'UTF-8') . '"'; } ?>>
										</div>
									</li>
			             		</ul>
							</fieldset>
						</div>
						
						<!-- End Applicant Two -->
				</div>
				
				<div class="row">
					<button class="blue-btn" name="send" id="send" type="submit">Submit Application</button>
				</div>
			
			</form>
				
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
