<?php

    //require_once('PhpConsole.php');
    //PhpConsole::start();

    require_once('includes/connection.inc.php');
    
    $pos = 0;
    $firstrow = true;
    define('SHOWMAX', 4);
    $conn = dbConnect('write');
   
    $getTotal = 'SELECT COUNT(*) FROM vrvInventory';
    
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
            vrvInventory.status, 
            vrvInvOptions.description
            FROM vrvInventory 
        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
        WHERE make = '$make'  AND visibility = 'Show'
        LIMIT $startrow, " . SHOWMAX;
    
    // submit the query and capture the result
    
    $result = $conn->query($sql) or die(mysqli_error($conn));
    

?>
	<div class="similar-units">

		<h3>Similar Units</h3>
			        
		<?php while ($row = $result->fetch_assoc()) { ?>
			
		<div class="sim-unit-info">	
		

			<div class=" row">	
				
				<div class="five columns">        
				        
				<?php 
				    
					$imgdir = "unit-img-sm/" . $row['stockNum'] . "/";
					$unit_imgs = glob($imgdir."*.jpg");
					                   
					if (empty($unit_imgs)) {
					
						echo  '<img src="img/img-coming-soon.png" alt="">';
					
					} else {
					
						$main_img = $unit_imgs[0];
						echo  '<img src="'. $main_img .'" alt="">';
					
					}
				
				?>
				
				</div>
				<div class="seven columns">
					<h5> <a href="rv-details.php?stockNum=<?php  echo $row['stockNum']; ?>"> <?php echo $row['year']; ?> <?php echo $row['make']; ?> <?php echo $row['model']; ?> <?php echo $row['model_num']; ?></a></h5>
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
				</div>
				
		
			</div> 
		        
		<?php } ?>
	
	</div>

		        		        
