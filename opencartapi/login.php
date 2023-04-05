<?php
require("db.php");
$_POST = json_decode(file_get_contents('php://input'), true);

/*
saba.fatemizadeh@gmail.com
admin
*/

$username=$_POST['username'];
$password=$_POST['password'];
if(is_numeric($username)){
	$q = mysqli_query($con,"SELECT * FROM " . "oc_customer WHERE telephone = '" . $username . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $password . "'))))) OR password = '" . md5($password) . "') AND status = '1'");

}
else{
	$q = mysqli_query($con,"SELECT * FROM " . "oc_customer WHERE LOWER(email) = '" . $username . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $password . "'))))) OR password = '" . md5($password) . "') AND status = '1'");
}

$response=array();
$response['status']="fail";
$response['message']="Login Failed";
while($data=mysqli_fetch_array($q)){
	$response['status']="success";
	$response['message']="Login Success";
	$str=$data['telephone'].$data['password'];
	$session=md5($str);
	$response['session']=$session;
	$response['customer_id']=$data['customer_id'];
	$customer_id=$data['customer_id'];
	$q2 = mysqli_query($con,"SELECT session FROM `oc_appsession` WHERE session='$session'");
	$session_exists=false;
	while($s2=mysqli_fetch_array($q2)){
		$session_exists=true;
	}
	if(!$session_exists){
		$q = mysqli_query($con,"INSERT INTO `oc_appsession` (customer_id,session) VALUES ('$customer_id','$session')");
	}
	$response['status']="success";
	$response['message']="Login Successfull";
}
echo json_encode($response);