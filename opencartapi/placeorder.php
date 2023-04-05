<?php

require("db.php");


$_POST = json_decode(file_get_contents('php://input'), true);

/*
{
  "customer_id": "0",
  "firstname": "Sukumar",
  "lastname": "Reddy A",
  "telephone": "7795029956",
  "telephone": "sukumar.inapp@gmal.com",
  "address_1": "Wood street",
  "address_2": "Near Richmond Tower",
  "city": "Bangalore",
  "postcode": "560025",
  "cart":[
      {
         "product_id":"28",
         "name":"Tomato Local - Naattu Thakkali",
         "quantity":1,
         "price":20
      },
      {
         "product_id":"105",
         "name":"Vegetables Combo Offers 100",
         "quantity":1,
         "price":100
      }
   ]
}
*/

$invoice_no="0";
$invoice_prefix="I";
$store_id=0;
$store_name='Hindustan Deal';
$store_url='https://hindustandeal.com';
$customer_group_id=1;

$customer_id=(int)$_POST['customer_id'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$telephone=$_POST['telephone'];
$email=$_POST['email'];
$address_1=$_POST['address_1'];
$address_2=$_POST['address_2'];
$city="Kanyakumari";
$postcode=$_POST['postcode'];

$country="India";
$country_id=99;
$zone="Tamil Nadu";
$zone_id="1503";
$method="Cash on Delivery";
$code="cod";

$payment_firstname=$_POST['firstname'];
$payment_lastname=$_POST['lastname'];
$shipping_firstname=$_POST['firstname'];
$shipping_lastname=$_POST['lastname'];
$shipping_address_1=$_POST['address_1'];
$shipping_address_2=$_POST['address_2'];
$shipping_city="Kanyakumari";
$shipping_postcode=$_POST['postcode'];
$shipping_country="India";
$shipping_country_id="99";

$shipping_method="Flat Shipping Rate";
$shipping_code="flat.flat";
$total=0;
$order_status_id=1;
$affiliate_id=1;
//affiliate_id
$commission=0;
//commission
$marketing_id=0;
$language_id=1;
$currency_id=4;
$currency_code="INR";
$currency_value=1;
$shipping=20.00;
$date_added=date("Y-m-d H:i:s");

$response=array();

$str="INSERT INTO `oc_order`(invoice_no,invoice_prefix,store_id,store_name,store_url,customer_id,customer_group_id,firstname,lastname,email,telephone,payment_firstname,payment_lastname,payment_address_1,payment_address_2,payment_city,payment_postcode,payment_country,payment_country_id,payment_zone,payment_method,payment_code,shipping_firstname,shipping_lastname,shipping_address_1,shipping_address_2,shipping_city,shipping_postcode,shipping_country,shipping_country_id,shipping_zone,shipping_method,shipping_code,total,order_status_id,affiliate_id,commission,marketing_id,language_id,currency_id,currency_code,currency_value,date_added,date_modified,payment_zone_id,shipping_zone_id) VALUES ('$invoice_no','$invoice_prefix','$store_id','$store_name','$store_url','$customer_id','$customer_group_id','$firstname','$lastname','$email','$telephone','$firstname','$lastname','$address_1','$address_2','$city','$postcode','$country','$country_id','$zone','$method','$code','$firstname','$lastname','$address_1','$address_2','$city','$postcode','$country','$country_id','$zone','$shipping_method','$shipping_code','$total','$order_status_id','$affiliate_id','$commission','$marketing_id','$language_id','$currency_id','$currency_code','$currency_value','$date_added','$date_added','$zone_id','$zone_id')";

$q=mysqli_query($con,$str);

$q=mysqli_query($con,"SELECT order_id FROM `oc_order` ORDER BY order_id  DESC");
$data=mysqli_fetch_array($q);
$order_id=$data['order_id'];
$seller_id = 1;
$products=$_POST['cart'];
foreach ($products as $product) {
	$product_id=$product['product_id'];
	$name=$product['name'];
	$quantity=$product['quantity'];
	$price=$product['price'];
  $admin_amount=$product['admin_amount'];
	$product_total=$product['price']*$quantity;
	$total = $total + $product_total;
	$q=mysqli_query($con,"INSERT INTO `oc_order_product` (order_id,product_id,name,quantity,price,total,seller_total,seller_id) VALUES('$order_id','$product_id','$name','$quantity','$price','$product_total',$admin_amount,$seller_id)");

}

$q=mysqli_query($con,"INSERT  INTO `oc_order_history` (order_id) VALUES ('$order_id')");



$q=mysqli_query($con,"INSERT  INTO `oc_order_total` (order_id,code,title,value) VALUES ('$order_id','sub-total','Sub-Total','$total')");


$q=mysqli_query($con,"INSERT  INTO `oc_order_total` (order_id,code,title,value) VALUES ('$order_id','shipping','Flat Shipping Rate','$shipping')");

$total_payable=0;
$total_payable=$total+$shipping;
$q=mysqli_query($con,"INSERT  INTO `oc_order_total` (order_id,code,title,value) VALUES ('$order_id','total','Total','$total_payable')");

$q=mysqli_query($con,"UPDATE `oc_order` set total='$total_payable' where order_id='$order_id'");


$response['order_id']=$order_id;

echo json_encode($response);
?>