<?php

require("db.php");

$_POST = json_decode(file_get_contents('php://input'), true);
$customer_id=$_POST['customer_id'];

$customer_id=1;

$q=mysqli_query($con,"SELECT firstname,lastname,address_1,address_2,city,postcode FROM `oc_address` WHERE customer_id='$customer_id'");

$data=array();
while ($row=mysqli_fetch_object($q)){
 $data[]=$row;
}

echo json_encode($data);
?>