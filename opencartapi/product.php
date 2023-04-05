<?php
require("db.php");
$response = array();
$_POST = json_decode(file_get_contents('php://input'), true);
$id=0;
$admin_margin = 0;
$price = 0;
$id = $_POST['id'];
//$id = isset($_GET['id'])?$_GET['id']:0;
$sql="SELECT product_id,name,description FROM `oc_product_description` WHERE product_id='$id'";
$result = mysqli_query($con,$sql);
$desc = '';
while($row=mysqli_fetch_assoc($result)){
	$response['product_id'] = $row['product_id'];
	$response["name"] = $row["name"];
	$description = strip_tags(html_entity_decode($row["description"]));
	$response["description"] = $description;
}
$sql="SELECT admin_margin_type,admin_margin,image,price FROM `oc_product` WHERE product_id='$id'";
$result = mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$response['image'] = $row['image'];
 	$price = $row['price'];
 	$admin_margin_type = $row['admin_margin_type'];
 	$admin_margin = $row['admin_margin'];
 	if($admin_margin_type == "percentage"){
 		$admin_margin = $price + $price * $admin_margin / 100;
 	}
 	$price = $price + $admin_margin;
	$response['price'] = $price;
}
$sql = "select * from oc_product_image where product_id='$id'";
$response['product_image']=array();
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($result)){
	$product_image = array();
	$product_image['image'] = $row['image'];
	array_push($response['product_image'], $product_image);
}
$sql = "select c.name,b.product_id,b.price,b.image from oc_product_related a,oc_product b,oc_product_description c where a.related_id=b.product_id and a.related_id=c.product_id and a.product_id='$id'";
$result = mysqli_query($con,$sql);
$response['related_product']=array();
while($row=mysqli_fetch_array($result)){
	$related_product = array();
	$related_product['product_id'] = $row['product_id'];
	$related_product['image'] = $row['image'];
	$related_product['price'] = $row['price'];
	$related_product["name"] = $row["name"];
	array_push($response['related_product'], $related_product);
}
echo json_encode($response,JSON_UNESCAPED_SLASHES);