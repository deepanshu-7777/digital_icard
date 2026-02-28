<?php

include "db.php";

$file = fopen($_FILES['file']['tmp_name'], "r");

fgetcsv($file); // Skip Header

while(($data = fgetcsv($file)) !== FALSE){

$employeeid = $data[0];
$name = $data[1];
$department = $data[2];
$phone = $data[3];
$email = $data[4];

$qr = "qr/".$employeeid.".png";

/* Generate QR Code */

$qrdata="http://localhost/employee_card/card.php?id=".$employeeid;

file_put_contents($qr,
file_get_contents(
"https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=".$qrdata
));

mysqli_query($conn,"INSERT INTO employees
(employeeid,name,department,phone,email,qr)

VALUES('$employeeid','$name','$department','$phone','$email','$qr')");

}

echo "CSV Imported Successfully";

?>