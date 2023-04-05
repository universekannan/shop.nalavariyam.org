<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("db.php");

$_POST = json_decode(file_get_contents('php://input'), true);
$response = array();
$status = "success";
$message = "";
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$telephone = trim($_POST['telephone']);
$email = trim($_POST['email']);
$password = md5($_POST['password']);
$address = $_POST['address'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$user = false;

$q = mysqli_query($con,"SELECT * FROM `oc_customer` WHERE email='$email'");
while($row=mysqli_fetch_array($q)){
	$message="A user already exists with this email id";
	$user=true;
}

$q = mysqli_query($con,"SELECT * FROM `oc_customer` WHERE telephone='$telephone'");
while($row=mysqli_fetch_array($q)){
	$message="Phone no already used by another user";
	$user=true;
}

if(!$user){
	$q = mysqli_query($con,"SELECT address_id FROM `oc_address` ORDER BY address_id DESC");
	$data=mysqli_fetch_array($q);
	$address_id=(int)$data['address_id']+1;
	$customer_group_id=1;
	$h = "5.5";
	$hm = $h * 60; 
	$ms = $hm * 60;
	$gmdate = gmdate("Y:m:d H:i:s", time()+($ms));
	$q = mysqli_query($con,"INSERT INTO `oc_customer`(customer_group_id,firstname,lastname,email,telephone,password,address_id,status,date_added) VALUES('$customer_group_id','$firstname','$lastname','$email','$telephone','$password','$address_id','1','$gmdate')") or die(mysqli_error($con));

	$q = mysqli_query($con,"SELECT customer_id FROM `oc_customer` ORDER BY customer_id DESC");
	$data=mysqli_fetch_array($q);
	$customer_id=(int)$data['customer_id'];

	
	$q = mysqli_query($con,"INSERT INTO `oc_address`(customer_id,firstname,lastname,address_1,city,postcode) VALUES('$customer_id','$firstname','$lastname','$address','$city','$postcode') ") or die(mysqli_error($con));

	$status='success';
	$message="Succussfully registered";
}
else{
	$status='fail';
}

$response['status']=$status;
$response['message']=$message;
echo json_encode($response);
?>