<?php
require("db.php");
$_POST = json_decode(file_get_contents('php://input'), true);
$email = trim($_POST['email']);

function mysendmail($email,$name,$token){
	include "mailer/PHPMailerAutoload.php";
	$mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth   = TRUE;
	$mail->SMTPSecure = "tls";
	$mail->Port       = 587;
	$mail->Host       = "smtp.gmail.com";
	$mail->Username   = "sukumar.inapp2@gmail.com";
	$mail->Password   = "rails2020";
    $body="Please click the following link to reset your password<br>";
    $body=$body."<a href='https://app.hindustandeal.com/reset.php?token=".$token."&email=".$email."'>Reset Password</a>";
    $mail->SetFrom("sukumar.inapp2@gmail.com", "Hindustan Deal");
    $mail->Subject = "Hindustan Deal Forgot Password";
    $mail->MsgHTML($body);
    $mail->AddAddress($email, $name);
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        die;
    }
}

$response = array();
$sql = "select * from oc_customer where email='$email'";
$result = mysqli_query($con,$sql) or die (mysqli_error($con));
if(mysqli_num_rows($result) > 0){
	$row = mysqli_fetch_array($result);
	$name = $row['firstname']." ".$row['lastname'];
	$email = trim($_POST['email']);
	$sql = "select * from password_reset where email='$email' and reset_status='pending'";
	$result = mysqli_query($con,$sql) or die (mysqli_error($con));
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_array($result);
		$token = $row['token'];
		mysendmail($email,$name,$token);
	}else{
		$token = md5(uniqid(rand(), true));
		mysendmail($email,$name,$token);
		$sql = "insert into password_reset (email,token,reset_status) values ('$email','$token','pending')";
		mysqli_query($con,$sql) or die (mysqli_error($con));
		mysendmail($email,$name,$token);
	}
	$response['status'] = "success";
	$response['message'] = "Please check your email to reset password";
}else{
	$response['status'] = "fail";
	$response['message'] = "Email does not exist";
}
echo json_encode($response);