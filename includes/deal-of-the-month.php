<?php

	if ($dealership == 'Both' || $dealership == 'Main') {

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
		WHERE deal_of_month = 'Yes' 
        ";
        
        } elseif ($dealership == 'South') {
	        
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
	        WHERE deal_of_month = 'Yes'  AND location = 'South'
			";
	        
        } elseif ($dealership == 'North') {
	      	
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
	        WHERE deal_of_month = 'Yes' AND location = 'North'
	        ";
	          
        }
   
   setlocale(LC_MONETARY, 'en_US');
 
    // submit the query and capture the result
    
    $result = $conn->query($sql) or die(mysqli_error($conn));
    

?>

	<?php while ($row = $result->fetch_assoc()) { ?>
		<!-- Deal of the Month -->
			<li class="deal-of-the-month">
				<div class="row">
					<h3><?php echo $row['year']; ?> <?php echo $row['make']; ?> <?php echo $row['model']; ?> <?php echo $row['model_num']; ?></h3>
					<p style="padding-left: 10px; margin: 0; font-size: 8px">Stock Number: <?php echo $row['stockNum']; ?></p>
				</div>
				<div class="row">
					<div class="deal-badge orange-btn">Deal of the Month</div>
				</div>
				
				<?php 
                    
                    $imgdir = "unit-img/" . $row['stockNum'] . "/";
                    $unit_imgs = glob($imgdir."*.jpg");
                    $main_img = $unit_imgs[0];
                                        
                ?>
                
				<div class="row">
					<div class="six columns">
						<div class="img-wrapper">
							<?php echo  '<img src="'. $main_img .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">'; ?>
						</div>
					</div>
					<div class="six columns">
						<div class="deal-grid">
							<ul>
								<li><?php echo  '<img src="'. $unit_imgs[1] .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">'; ?></li>
								<li><?php echo  '<img src="'. $unit_imgs[2] .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">'; ?></li>
								<li><?php echo  '<img src="'. $unit_imgs[3] .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">'; ?></li>
								<li><?php echo  '<img src="'. $unit_imgs[4] .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">'; ?></li>
								<li><?php echo  '<img src="'. $unit_imgs[5] .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">'; ?></li>
								<li><?php echo  '<img src="'. $unit_imgs[6] .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">'; ?></li>
							</ul>
						</div>
						<?php if ($row['sale']) {?>
							<h2 class="blue-btn"><a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>"><?php echo money_format('%.0n', $row['sale']); ?></a></h2>
						<?php } else { ?>
							<h2 class="blue-btn"><a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>">Get More Info</a></h2>
						<?php } ?>
					</div>
				</div>
			</li>
			<!-- End Deal of the Month -->
        <?php } ?>
		        
	    
		            
		         
