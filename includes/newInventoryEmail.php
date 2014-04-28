<?php
$salesdept=1;
include 'connection.inc.php';
$conn = dbConnect('write');
$subject="Vogt RV - Daily New Inventory Report"; 
$query = "SELECT stockNum, year, make, model, model_num from vrvInventory where timestamp >= CURRENT_DATE() - INTERVAL 9 hour";
    $stmt = $conn->stmt_init();    
    if ($stmt->prepare($query)) {
        $stmt->bind_result($stockNum, $year, $make, $model, $model_num);
        $stmt->execute();
        $stmt->store_result();
        
    } else {
        echo $stmt->error;
    }
$body = "New Inventory Summary - " . date("F j, Y, g:i a") . ": ";
$body .= "<br><br>";
$body .= "<html>";
	$body .="<table>";
		$body .= "<tr>";
			$body .= "<th>";
				$body .= "Stock #";
			$body .= "</th>";
			$body .= "<th>";
				$body .= "Year";
			$body .= "</th>";

			$body .= "<th>";
				$body .= "Make";
			$body .= "</th>";
			$body .= "<th>";
				$body .= "Model";
			$body .= "</th>";
			$body .= "<th>";
				$body .= "Model Number";
			$body .= "</th>";
		$body .= "</tr>";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Vogt Sales - Inventory <noreply@vogtrv.com>' . "\r\n";
		$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		while ($stmt->fetch()) {
			$body .= "<tr><td>" . $stockNum . "</td><td>" . $year . "</td><td>" . $make . "</td><td>" . $model . "</td><td>" . $model_num . "</td></tr>";
		}
	$body .= "</table>";
$body .= "</html>";
mail("bmckamie@vogtrv.com", $subject, $body, $headers); 
?>