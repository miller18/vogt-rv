<?php

	if ($dealership == 'Both' || $dealership == 'Main') {

	    $sql = "SELECT 
	            vrvInventory.stockNum,
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
	            vrvInventory.featured, 
	            vrvInventory.status, 
	            vrvInventory.visibility, 
	            vrvInvOptions.options,
	            vrvInvOptions.miles,
	            vrvInvOptions.uvw,
	            vrvInvOptions.vin_num,
	            vrvInvOptions.description,
	            vrvInvStandards.map,
	            vrvInvStandards.map_priced
	        FROM vrvInventory 
	        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
	        LEFT JOIN vrvInvStandards ON vrvInventory.model_num = vrvInvStandards.model_num AND vrvInventory.model = vrvInvStandards.model AND vrvInventory.year = vrvInvStandards.year
	        WHERE vrvInventory.featured = 'Yes' AND vrvInventory.status = 'Available'
	        ORDER BY RAND()
	        LIMIT 3";
        
        } elseif ($dealership == 'South') {
	        
	    	$sql = "SELECT 
	            vrvInventory.stockNum,
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
	            vrvInventory.featured, 
	            vrvInventory.status, 
	            vrvInventory.visibility, 
	            vrvInvOptions.options,
	            vrvInvOptions.miles,
	            vrvInvOptions.uvw,
	            vrvInvOptions.vin_num,
	            vrvInvOptions.description,
	            vrvInvStandards.map,
	            vrvInvStandards.map_priced
	        FROM vrvInventory 
	        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
	        LEFT JOIN vrvInvStandards ON vrvInventory.model_num = vrvInvStandards.model_num AND vrvInventory.model = vrvInvStandards.model AND vrvInventory.year = vrvInvStandards.year
		    WHERE vrvInventory.featured = 'Yes' AND vrvInventory.location = 'South' AND vrvInventory.status = 'Available'
	        ORDER BY RAND()
	        LIMIT 3";
        
	        
        } elseif ($dealership == 'North') {
	      	
	      	$sql = "SELECT 
	            vrvInventory.stockNum,
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
	            vrvInventory.featured, 
	            vrvInventory.status, 
	            vrvInventory.visibility, 
	            vrvInvOptions.options,
	            vrvInvOptions.miles,
	            vrvInvOptions.uvw,
	            vrvInvOptions.vin_num,
	            vrvInvOptions.description,
	            vrvInvStandards.map,
	            vrvInvStandards.map_priced
	        FROM vrvInventory 
	        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
	        LEFT JOIN vrvInvStandards ON vrvInventory.model_num = vrvInvStandards.model_num AND vrvInventory.model = vrvInvStandards.model AND vrvInventory.year = vrvInvStandards.year
		    WHERE vrvInventory.featured = 'Yes' AND vrvInventory.location = 'North' AND vrvInventory.status = 'Available'
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
							<p style="padding-left: 10px; margin: 0 0 -15px 0; position: relative; font-size: 8px">Stock Number: <?php echo $row['stockNum']; ?></p>
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
							<?php 

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

                            <?php if($displayed_price > 0) { ?>
                            	<?php if($row['specials'] == '2') { ?>
									<a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>" class="green-btn"><?php echo money_format('%.0n', $displayed_price); ?></a>
								<?php } else { ?>
									<a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>" class="orange-btn"><?php echo money_format('%.0n', $displayed_price); ?></a>
								<?php } ?>	
							<?php } else { ?>
								<?php if($row['specials'] == '2') { ?>
									<a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>" class="green-btn">Managers Special</a>
								<?php } else { ?>	
									<a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>" class="blue-btn">More Info</a>
								<?php } ?>
							<?php } ?>
						</div>
					</li>
        
	                        
                             		        
		        <?php } ?>
		        
		        </ul>
		    </div>
	    
		            
		         
