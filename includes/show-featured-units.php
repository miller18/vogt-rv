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
        WHERE show_unit = 'Yes' AND visibility = 'Show'
        ORDER BY RAND()
        LIMIT 6";
        
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
			WHERE show_unit = 'Yes' AND visibility = 'Show' AND location = 'South'
	        ORDER BY RAND()
	        LIMIT 6";
	        
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
	        WHERE show_unit = 'Yes' AND visibility = 'Show' AND location = 'North'
	        ORDER BY RAND()
	        LIMIT 6";
	          
        }
    
    // submit the query and capture the result
    
    $result = $conn->query($sql) or die(mysqli_error($conn));
    setlocale(LC_MONETARY, 'en_US');

?>
		
		<div class="row specials">
				<ul>
				
					<?php while ($row = $result->fetch_assoc()) { ?>
					
					<li>
						<div class="specials-unit">
							<h5><?php echo $row['year']; ?> <?php echo $row['make']; ?><br> <?php echo $row['model']; ?> <?php echo $row['model_num']; ?></h5>
							<?php 
                                
	                            $imgdir = "unit-img/" . $row['stockNum'] . "/";
	                            $unit_imgs = glob($imgdir."*.jpg");
	                                           
	                            if (empty($unit_imgs)) {
	                        
	                                echo  '<img src="img/img-coming-soon.png" alt="">';
	                        
	                            } else {
	                        
	                                $main_img = $unit_imgs[0];
	                                echo  '<img src="'. $main_img .'" alt="' .$row['year'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' .$row['model_num'] .'">';
	                    
	                            }
                        
							?>
							<!--
							<p>
								<?php
                                    
	                                if (!empty($row['description'])) {
	                                    
	                                    echo $row['description'];
	                                    
	                                } else {
	                                    
	                                    echo "Vogt RV is the value leader, and the place to come for your next RV.  This " . $row['year'] . " " . $row['make'] . " " . $row['model'] . " " . $row['model_num']  . " is just an example of the high-quality RVs available at Vogt, your North Texas RV Value leader."; 
	                                    
	                                }
	                                
	                            ?> 
								
							</p>
							-->
								<a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>" class="blue-btn">More Info</a>
							
						</div>
					</li>
        
	                        
                             		        
		        <?php } ?>
		        
		        </ul>
		    </div>
	    
		            
		         
