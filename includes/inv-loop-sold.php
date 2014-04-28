<?php while ($row = $result->fetch_assoc()) { ?>
	<div class="inventory-listing">
    
	<div class="row">
    
		<table class="rounded inv-table">
			<thead>
				<tr>
					<th class="unit-title"> <a href="rv-details-sold.php?stockNum=<?php  echo $row['stockNum']; ?>"><?php  echo $row['year']; ?> <?php echo $row['make']; ?> <?php echo $row['model']; ?> <?php echo $row['model_num']; ?></a></th>
					
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
	                                    <td>MSRP:</td>
	                                    <td> <?php echo money_format('%.0n', $row['msrp']);?></td>
	                                </tr>
	                                
	                                <?php } ?>
	                                
	                                <?php if ($row['sale'] > 0 && $row['msrp'] > 0) { ?>
	                                
	                                <tr class="discount">
	                                    <td>Discount:</td>
	                                    
	                                    <?php  $discount = $row['msrp'] - $row['sale']; ?>
	                                    
										<td><?php echo money_format('%.0n', $discount); ?></td>
	                                </tr>
	                                   
	                                <?php } ?>
	                                
	                                <?php if ($row['sale'] > 0) { ?>
	                                
	                                <tr class="sale-price">
	                                    <td>Sale:</td>
	                                    <td><?php echo money_format('%.0n', $row['sale']); ?></td>
	                                </tr>
	                                
	                                <?php } else { ?>
	                                
	                                <tr>
	                                	
	                                	<td colspan="2" text-align="center"><a href="dealmaker.php?stocknum=<?php echo $row['stockNum']; ?>" target="_blank" class="orange-btn"  onclick="MM_openBrWindow('dealmaker.php?stocknum=<?php echo  $row['stockNum']; ?>','The RV Dealmaker','scrollbars=yes,width=800,height=550'); return false;">Our Special Price</a></td>
	                                    
	                                </tr>
	                                
	                                <?php } ?>
	                            
	                            </tbody>
	                        </table>
	                        
	                        <?php 
                            $filename = "msrp/" . $row['stockNum'] . ".pdf" ;
							if (count(glob($filename)) > 0) { ?>
							    <a href="/msrp/<?php echo $row['stockNum']; ?>.pdf" target="_blank" class="blue-btn" >Download the MSRP</a>
							<?php	}	?>   
							
						</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	
	</div>
	</div>
	<?php } ?>