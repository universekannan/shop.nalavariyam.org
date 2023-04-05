<?php
require("db.php");
$_POST = json_decode(file_get_contents('php://input'), true);
$email = trim($_POST['email']);
$token = trim($_POST['token']);
$password = md5(trim($_POST['password']));

$response = array();
$response['status'] = "fail";
$response['message'] = "Password reset failed";
$sql = "select * from password_reset where email='$email' and token='$token' and reset_status='pending'";
$result = mysqli_query($con,$sql) or die (mysqli_error($con));
if(mysqli_num_rows($result)>0){
	$sql = "update oc_customer set password='$password' where email='$email'";
	mysqli_query($con,$sql) or die (mysqli_error($con));
	$sql = "update password_reset set reset_status='completed' where email='$email' and token='$token'";
	mysqli_query($con,$sql) or die (mysqli_error($con));
	$response['status'] = "success";
	$response['message'] = "Password reset successfully";
}
echo json_encode($response);