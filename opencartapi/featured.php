<?php

require("db.php");
$admin_margin = 0;
$price = 0;

$q=mysqli_query($con,"SELECT setting FROM `oc_module` where name='Home Page' AND code='featured'");

$data=mysqli_fetch_array($q);

$setting=json_decode($data['setting'],true);

echo '[';
$lastElement = end($setting['product']);
foreach ($setting['product'] as $product_id) {

	echo '{';
	$q=mysqli_query($con,"SELECT name FROM `oc_product_description` WHERE product_id='$product_id'");
	$row=mysqli_fetch_array($q);
	$description=$row;
	echo '"name":"'.$description['name'].'",';

	$q=mysqli_query($con,"SELECT admin_margin_type,admin_margin,product_id,quantity,image,price FROM `oc_product` WHERE product_id='$product_id'");

	$row=mysqli_fetch_array($q);
 	$details=$row;
 	$price = $details['price'];
 	$admin_margin_type = $details['admin_margin_type'];
 	$admin_margin = $details['admin_margin'];
 	if($admin_margin_type == "percentage"){
 		$admin_margin = $price + $price * $admin_margin / 100;
 	}
 	$price = $price + $admin_margin;
 	echo '"product_id":"'.$details['product_id'].'",';
 	echo '"quantity":"'.$details['quantity'].'",';
 	echo '"image":"'.$details['image'].'",';
 	echo '"price":"'.$price.'",';
 	echo '"admin_margin":"'.$admin_margin.'",';


	$q=mysqli_query($con,"SELECT price FROM `oc_product_special` WHERE product_id='$product_id'");

	$row=mysqli_fetch_array($q);
	$discount=$row;
	if($discount['price']==null){
		echo '"dprice":"'.$details['price'].'"}';
	}
	else{
		echo '"dprice":"'.$discount['price'].'"}';
	}
	

	if($product_id!= $lastElement) {
		echo ",";
	}
}
echo ']';
?>