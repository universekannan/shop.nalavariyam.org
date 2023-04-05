<?php
require("db.php");
$response=array();
$q=mysqli_query($con,"select * from oc_setting where `key` = 'shipping_flat_cost'");
while($row=mysqli_fetch_array($q)){
	$response['charge'] =  $row['value'];
}
echo json_encode($response);
	

