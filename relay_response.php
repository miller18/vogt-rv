<?php require_once 'anet_php_sdk/AuthorizeNet.php'; // The SDK
$redirect_url = "https://vogtrv.com/order_receipt.php"; // Where the user will end up.
$api_login_id = '9kG342WgKaF';
$md5_setting = "9kG342WgKaF"; // Your MD5 Setting
$response = new AuthorizeNetSIM($api_login_id, $md5_setting);
if ($response->isAuthorizeNet())
{
if ($response->approved)
 {
 // Update vrvDepositsPending table with date, stock #
	 function dbConnect($usertype, $connectionType = 'mysqli') {
    global $connection;
    //$host = 'vrvTest.db.11732073.hostedresource.com';
    $host = 'vrvprod.vogtrv.com';
    $db = 'vrvprod';
    
    if ($usertype  == 'read') {
        $user = 'miller18';
        $pwd = '!2Rbaayyeg318';
    } elseif ($usertype == 'write') {
        $user = 'miller18';
        $pwd = '!2Rbaayyeg318';
    } else {
        exit('Unrecognized connection type');
    }
    
    if ($connectionType == 'mysqli') {
        $connection = new mysqli($host, $user, $pwd, $db) or die ('Cannot open database');
        return $connection;
    } else {
        try {
            return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch (PDOException $e) {
            echo 'Cannot connect to database';
            exit;
        }
    }
}

	
    	 $conn = dbConnect('write');


	$query = "select last_name, first_name, email_address from vrvEmployees where staff_id = $response->invoice_num";
 	$stmt = $conn->stmt_init();    
    	if ($stmt->prepare($query)) {
        $stmt->bind_result($lname, $fname, $email_address);
        $stmt->execute();
        $stmt->store_result();
        
    } else {
        echo $stmt->error;
    }
		while ($stmt->fetch()) {
			$salesman = $lname . ", " . $fname;
			$salesman_email = $email_address;
		}
	

 // Email required parties (internal to Vogt RV)
	if ($response->amount < 1000) {
		$to_email=$salesman_email . ",towableDepositReceivedNotificationList@vogtrv.com";
	}else {
		$to_email=$salesman_email . ",motorizedDepositReceivedNotificationList@vogtrv.com";
	}
	$from_email = "no-reply@vogtrv.com";
	$subject = "Purchase Deposit Approved - " . $response->last_name . ", " . $response->first_name;
	$message = "Customer: " . $response->last_name . ", " . $response->first_name . "\nApproval #: " . $response->auth_code . "\nTransaction ID #: " . $response->trans_id . "\nDeposit Amount #: " . $response->amount . "\nPhone Number #: " . $response->phone . " \nStock #: " . $response->description . " \nSalesman : " . $salesman;
	mail($to_email, $subject, $message); 

	$last_name = mysqli_real_escape_string($conn,$response->last_name);
	$first_name = mysqli_real_escape_string($conn,$response->first_name);
	$statement = "insert into vrvDeposits (timestamp, refundable, lname, fname, amount, depositDuration, stockNum, salesman) values(now(), 'True', '$last_name', '$first_name', $response->amount, 48, '$response->description', '$response->invoice_num');";
	$result = $conn->query($statement) or die(mysqli_error($conn));












 // Update CRM tables *future use*

 $redirect_url .= '?response_code=1&transaction_id=' .
 $response->transaction_id . '&email=' . $response->email; }
 else
 {
 $redirect_url .= '?response_code='.$response->response_code . 
'&response_reason_text=' . $response->response_reason_text; 
 }
 // Send the Javascript back to AuthorizeNet, which will redirect user back to your site.
 echo AuthorizeNetDPM::getRelayResponseSnippet($redirect_url);
}
else
{
echo "Error. Check your MD5 Setting.";
}?>