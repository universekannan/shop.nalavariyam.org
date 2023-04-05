<?php
require("db.php");
$response=array();
$admin_margin = 0;
$price = 0;
$_POST = json_decode(file_get_contents('php://input'), true);
$search= isset($_POST['search']) ? $_POST['search']:"";
$q=mysqli_query($con,"select a.product_id,a.name,a.description,b.quantity,b.admin_margin_type,b.admin_margin,b.image,b.price from oc_product_description a,oc_product b where a.product_id=b.product_id and a.name like '%$search%' limit 10;");
$i=0;
while($row=mysqli_fetch_array($q)){
	$response[$i]['name'] =  $row['name'];
 	$price = $row['price'];
 	$admin_margin_type = $row['admin_margin_type'];
 	$admin_margin = $row['admin_margin'];
 	if($admin_margin_type == "percentage"){
 		$admin_margin = $price + $price * $admin_margin / 100;
 	}
 	$price = $price + $admin_margin;
	$response[$i]['admin_margin'] = $admin_margin;
	$response[$i]['price'] = $price;
	$response[$i]['image'] =  $row['image'];
	$response[$i]['product_id'] =  $row['product_id'];
	$response[$i]['quantity'] =  $row['quantity'];
	//$response[$i]['description'] =  $row['description'];
	$i++;
}
echo json_encode($response);
	