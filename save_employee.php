<?php

include "db.php";

$id=$_POST['employeeid'];

$name=$_POST['name'];
$department=$_POST['department'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];
$emergency=$_POST['emergency_contact'];
$company=$_POST['company_address'];

$photo=$_FILES['photo']['name'];

move_uploaded_file($_FILES['photo']['tmp_name'],
"photos/".$photo);

$qr="qr/".$id.".png";

$qrdata="http://localhost/employee_card/card.php?id=".$id;

file_put_contents($qr,
file_get_contents(
"https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=".$qrdata
));

mysqli_query($conn,"INSERT INTO employees
(employeeid,name,department,phone,email,qr,photo,address,emergency_contact,company_address)

VALUES('$id','$name','$department','$phone','$email','$qr','$photo','$address','$emergency','$company')");
header("Location:dashboard.php");

?>