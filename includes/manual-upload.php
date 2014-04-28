<?php

// 10/28/13 - gbm



    require_once('connection.inc.php');
    $conn = dbConnect('write');
    $xml_inv = simplexml_load_file("/home/danvog/vogtrv.com/feed/inbound/Web_Inventory_Vogt RV.xml"); 
    foreach ($xml_inv as $row) {
        $stockNum = $row->stock_number;
        switch ($row->type_code) {
            case "A":
                $type = 'Class A';
                break;
            case "O":
                $type = 'Other';
                break;
            case "5W":
                $type = 'Fifth Wheel';
                break;
            case "TT":
                $type = 'Travel Trailer';
                break;
            case "B":
                $type = 'Class B';
                break;
            case "C":
                $type = 'Class C';
                break;
            case "DD":
                $type = 'Diesel Pusher';
                break;
            case "FD":
                $type = 'Tent Camper';
                break;
        }
        
        if ($row->gl_location_code == 'VRV') {
            $location = 'South';
        }  elseif ($row->gl_location_code == 'VNO')  {
            $location = 'North';
        }    
        
        $year = $row->model_year;
        $make =$row->manufacturer;
        $model = $row->brand;
        $model_num = $row->model;
	 $mileage = $row->mileage;
	 $chassis_no = $row->chassis_no;
	 $exterior_color = $row->exterior_color;
	 $interior_color = $row->interior_color;
         if ($row->designation_code == 'U') {
            $unit_condition = 'Pre Owned';
            $msrp = 0.00;
        }  elseif ($row->designation_code == 'N')  {
            $unit_condition = 'New';
            $msrp = $row->factory_list;
        }  
        $status = $row->status;
        if ($status == 'FINAL SALE') {
            $status = 'Sold';

        }
        $sql_check = "SELECT * FROM vrvInventory WHERE stockNum = '$stockNum'";
        $count = $conn->query($sql_check) or die(mysqli_error($conn));
        $row_count = $count->num_rows;
		echo $stockNum.": ".$row_count ."<br>";
        if ($row_count > 0) {
	    	$conn->autocommit(FALSE); 
         		if ($status=='Sold' ) {
					//set sold date = today if status = sold
	     			$sql_update = "UPDATE vrvInventory SET status ='$status', soldDate = now() WHERE stockNum='$stockNum'";
	 			}else{
					$sql_update = "UPDATE vrvInventory SET status ='$status', vin='$chassis_no' WHERE stockNum='$stockNum'";
	 	 		}       
				$sql_update_execute = $conn->query($sql_update) or die(mysqli_error($conn));
	     		if ($sql_update_execute) {
   					$conn->commit();
				}else{
					echo "update failed: ". $stockNum."<br>";       
  		 	 		$conn->rollback();
				}
        } else {
            $conn->autocommit(FALSE);
            $sql_add = "INSERT INTO vrvInventory (stockNum, vin, type, location, year, make, model, model_num, unit_condition, msrp, status, visibility, timeStamp) VALUES ('$stockNum', '$chassis_no', '$type', '$location', '$year', ucwords('$make'), ucwords('$model'), '$model_num', ucwords('$unit_condition'), '$msrp', '$status', 'Hide', now())";
			echo $sql_add."<br>";
            $inv_add = $conn->query($sql_add) or die(mysqli_error($conn));
            $sql_add2 = "INSERT INTO vrvInvOptions (stockNum, miles, int_color, ext_color) VALUES ('$stockNum', '$mileage', ucwords('$interior_color'), ucwords('$exterior_color'))";
            echo $sql_add2."<br>";
            $inv_add2 = $conn->query($sql_add2) or die(mysqli_error($conn));
	     	if ($inv_add and $inv_add2) {
   				$conn->commit();
			} else {
				echo "insert failed: ". $stockNum."<br>";
  		  		$conn->rollback();
			}
        }
   }
?>