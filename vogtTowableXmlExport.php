<?php 
$host="vrvprod.vogtrv.com";
$port=3306;
$user="miller18";
$password="!2Rbaayyeg318";
$dbname="vrvprod";
$mysqli = new mysqli($host, $user, $password, $dbname, $port) or die ('Could not connect to the database server' . mysqli_connect_error());


$query = "SELECT 
	     vrvInventory.stockNum,
	     vrvInventory.vin,
            vrvInventory.year, 
            vrvInventory.make, 
            vrvInventory.model, 
            vrvInventory.model_num, 
            vrvInventory.msrp, 
            vrvInventory.sale, 
            vrvInventory.type, 
            vrvInventory.location, 
            vrvInventory.unit_condition, 
            vrvInvOptions.int_color, 
            vrvInvOptions.ext_color, 
            vrvInventory.status, 
            vrvInvOptions.options,
            vrvInvOptions.miles,
            vrvInvOptions.uvw,
            vrvInvOptions.vin_num,
            vrvInvOptions.description,
            vrvInvStandards.standards,
            vrvInvStandards.floorplan, 
            vrvInvStandards.gvwr,
            vrvInvStandards.unit_length_ft, 
            vrvInvStandards.unit_length_in,
            vrvInvStandards.slides,
            vrvInvStandards.sleeping_capacity,
            vrvInvStandards.chassis,
            vrvInvStandards.engine,
            vrvInvStandards.fuel_type,
            vrvInvStandards.black_water,
            vrvInvStandards.grey_water,
            vrvInvStandards.fresh_water
        FROM vrvInventory 
        LEFT JOIN vrvInvOptions ON vrvInventory.stockNum = vrvInvOptions.stockNum 
        LEFT JOIN vrvInvStandards ON vrvInventory.model_num = vrvInvStandards.model_num AND vrvInventory.model = vrvInvStandards.model AND vrvInventory.year = vrvInvStandards.year where vrvInventory.location = 'North' and type <> 'Other' and status <> 'Sold'";
$result = $mysqli->query($query);



$dom = new DomDocument('1.0', 'UTF-8');
$inventory = $dom->createElement('inventory');
$dealerElem = $dom->createElement('dealer');
$dealerElem->appendChild( $dom->createElement('id', '3649') );
$dealerElem->appendChild($dom->createElement('Name'))
              ->appendChild($dom->createCDATASection('Vogt RV Centers'));
$dealerElem->appendChild($dom->createElement('Address'))
              ->appendChild($dom->createCDATASection('5301 Airport Freeway'));
$dealerElem->appendChild($dom->createElement('City'))
              ->appendChild($dom->createCDATASection('Fort Worth'));
$dealerElem->appendChild($dom->createElement('State'))
              ->appendChild($dom->createCDATASection('Texas'));
$dealerElem->appendChild($dom->createElement('Zip'))
              ->appendChild($dom->createCDATASection('76117'));
$dealerElem->appendChild($dom->createElement('Phone'))
              ->appendChild($dom->createCDATASection('817-831-1800'));
$unitsElem = $dom->createElement('units');
//start unit loop
while ($row = $result->fetch_assoc()) {
$stockNum=$row['stockNum'];
$length = $row['unit_length_ft'] . "ft " . $row['unit_length_in'] . "in";
$unitElem = $dom->createElement('unit');
$unitElem->appendChild($dom->createElement('id'))
              ->appendChild($dom->createCDATASection($stockNum));
$unitElem->appendChild($dom->createElement('Type'))
              ->appendChild($dom->createCDATASection($row['type']));
$unitElem->appendChild($dom->createElement('Condition'))
              ->appendChild($dom->createCDATASection($row['unit_condition']));
$unitElem->appendChild($dom->createElement('Stock_Number'))
              ->appendChild($dom->createCDATASection($stockNum));
$unitElem->appendChild($dom->createElement('Year'))
              ->appendChild($dom->createCDATASection($row['year']));
$unitElem->appendChild($dom->createElement('Brand'))
              ->appendChild($dom->createCDATASection($row['make']));
$unitElem->appendChild($dom->createElement('Model'))
              ->appendChild($dom->createCDATASection($row['model']));
$unitElem->appendChild($dom->createElement('Floorplan'))
              ->appendChild($dom->createCDATASection($row['model_num']));
$unitElem->appendChild($dom->createElement('Length'))
              //->appendChild($dom->createCDATASection($row['length']));
		->appendChild($dom->createCDATASection($length));
$unitElem->appendChild($dom->createElement('MSRP'))
              ->appendChild($dom->createCDATASection($row['msrp']));
$unitElem->appendChild($dom->createElement('Price'))
              ->appendChild($dom->createCDATASection($row['price']));
$unitElem->appendChild($dom->createElement('Sale_Price'))
              ->appendChild($dom->createCDATASection($row['sale']));
$unitElem->appendChild( $dom->createElement('Freight_Cost', '') );
$unitElem->appendChild($dom->createElement('Description'))
              ->appendChild($dom->createCDATASection($row['description']));
$unitElem->appendChild( $dom->createElement('Chassis', '') );
$unitElem->appendChild( $dom->createElement('Engine_Manufacturer', '') );
$unitElem->appendChild( $dom->createElement('Engine_Model', '') );
$unitElem->appendChild( $dom->createElement('Fuel_Type', '') );
$unitElem->appendChild($dom->createElement('Interior_Color'))
              ->appendChild($dom->createCDATASection($row['int_color']));
$unitElem->appendChild($dom->createElement('Exterior_Color'))
              ->appendChild($dom->createCDATASection($row['ext_color']));
$unitElem->appendChild($dom->createElement('Sleep_Capacity'))
              ->appendChild($dom->createCDATASection($row['sleeping_capacity']));
$unitElem->appendChild( $dom->createElement('Water_Capacity_Fresh', '') );
$unitElem->appendChild( $dom->createElement('Water_Capacity_Black', '') );
$unitElem->appendChild( $dom->createElement('Water_Capacity_Grey', '') );
$unitElem->appendChild($dom->createElement('Mileage'))
              ->appendChild($dom->createCDATASection($row['miles']));
$unitElem->appendChild($dom->createElement('Dry_Weight'))
              ->appendChild($dom->createCDATASection($row['uvw']));
$unitElem->appendChild($dom->createElement('Num_Slideouts'))
              ->appendChild($dom->createCDATASection($row['slides']));;
$unitElem->appendChild($dom->createElement('Vin'))
              ->appendChild($dom->createCDATASection($row['vin']));
$imagesElem = $dom->createElement('Images');
//start image loop
$imgdir = "unit-img/" . $row['stockNum'] . "/";
$unit_imgs = glob($imgdir."*.jpg");
//echo (sizeof($unit_imgs));
if (empty($unit_imgs)) {
} else {
        foreach($unit_imgs as $unit_img) {
		$imagesElem->appendChild($dom->createElement('Image'))
              	->appendChild($dom->createCDATASection('http://vogtrv.com/' . $unit_img));

         //'<div class="rotation-img"><li> <img src="/'.$unit_img.'" alt=""> <div class="orbit-caption">' . $year . ' ' . $make . ' ' . $model . ' ' . $model_num . '</div></li></div>';
        }
                                         
}
$unitElem->appendChild( $imagesElem );
$unitsElem->appendChild( $unitElem );
//end of unit loop
}
$dealerElem->appendChild( $unitsElem );
$inventory->appendChild( $dealerElem );
$dom->appendChild( $inventory );
   if ( $dom->save('/home/danvog/vogtrv.com/feed/outbound/vogtTowableInventory.xml') ) 
	{echo "good to go";}
	else
	{echo "nogo";}
?>