<html>

<head>
</head>

<body>

<?php

    //require_once('PhpConsole.php');
    //PhpConsole::start();

    require_once('connection.inc.php');
    
    $conn = dbConnect('write');
   
    echo "<p>Loading XML file ... </p>";
    
    $xml_inv = simplexml_load_file("Web_Inventory_Vogt_RV.xml");
    
    
    
    foreach ($xml_inv as $row) {
        $stockNum = mysql_real_escape_string($row->stock_number);
        
        switch (mysql_real_escape_string($row->type_code)) {
            
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
        
        if (mysql_real_escape_string($row->gl_location_code) == 'VRV') {
            $location = 'South';
        }  elseif (mysql_real_escape_string($row->gl_location_code) == 'VNO')  {
            $location = 'North';
        }    
        
        $year = mysql_real_escape_string($row->model_year);
        $make = mysql_real_escape_string($row->manufacturer);
        $model = mysql_real_escape_string($row->brand);
        $model_num = mysql_real_escape_string($row->model);
         if (mysql_real_escape_string($row->designation_code) == 'U') {
            $unit_condition = 'Pre Owned';
        }  elseif (mysql_real_escape_string($row->designation_code) == 'N')  {
            $unit_condition = 'New';
            $msrp = mysql_real_escape_string($row->factory_list);
        }  
        
        $status = mysql_real_escape_string($row->status);
        
        if(mysql_real_escape_string($row->status_code) == 'A') {
            if(mysql_real_escape_string($row->type_code) == 'O') {
                $visibility = 'Hide';
            } else {
                $visibility = 'Show'; 
            }   
        } else {
            $visibility = 'Hide';
        }
        
        $sql_check = "SELECT * FROM vrvInventory WHERE stockNum = '$stockNum'";
        $count = $conn->query($sql_check) or die(mysqli_error($conn));
        $row_count = $count->num_rows;
        
        if ($row_count > 0) {
         
            echo "<p>" . $stockNum . " already exists in the table</p>";   
            $sql_update = "UPDATE vrvInventory SET status ='$status', visibility='$visibility' WHERE stockNum='$stockNum'";
            echo $sql_update;
        
            $inv_update = $conn->query($sql_update) or die(mysqli_error($conn));

        } else {
        
            $sql_add = "INSERT INTO vrvInventory (stockNum, type, location, year, make, model, model_num, unit_condition, msrp, status, visibility) VALUES ('$stockNum', '$type', '$location', '$year', '$make', '$model', '$model_num', '$unit_condition', '$msrp', '$status', '$visibility')";
        
            $inv_add = $conn->query($sql_add) or die(mysqli_error($conn));
        }
   }
    
    

?>

</body>
</html>
            