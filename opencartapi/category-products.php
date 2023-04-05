<?php

require("db.php");
$admin_margin = 0;
$price = 0;
$_POST = json_decode(file_get_contents('php://input'), true);
$category_id=$_POST['category_id'];

$q=mysqli_query($con,"select product_id from `oc_product_to_category` where category_id='$category_id'");


$data=array();
while ($row=mysqli_fetch_array($q)){
 $data[]=$row;
}

$lastElement = end($data);
echo '[';
foreach ($data as $product) {
	$p=$product['product_id'];

	echo '{';
	$q=mysqli_query($con,"SELECT name,description FROM `oc_product_description` WHERE product_id='$p'");
	$row=mysqli_fetch_array($q);
	$description=$row;
	echo '"name":"'.$description['name'].'",';
	//echo '"description":"'.$description['description'].'",';
	//  enum('percentage','fixed')
	//
	$q=mysqli_query($con,"SELECT admin_margin_type,admin_margin,product_id,quantity,image,price FROM `oc_product` WHERE product_id='$p'");

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
 		
	$q=mysqli_query($con,"SELECT price FROM `oc_product_special` WHERE product_id='$p'");

	$row=mysqli_fetch_array($q);
	$discount=$row;
	if($discount['price']==null){
		echo '"dprice":"'.$details['price'].'"}';
	}
	else{
		echo '"dprice":"'.$discount['price'].'"}';
	}
	

	if($product!= $lastElement) {
		echo ',';
	}
}

echo ']';

?>
