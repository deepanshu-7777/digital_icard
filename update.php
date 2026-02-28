<?php

include "db.php";

$id = $_POST['employeeid'];

$name = $_POST['name'];
$department = $_POST['department'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$emergency = $_POST['emergency_contact'];
$company = $_POST['company_address'];

$photo = $_FILES['photo']['name'];


/* If new photo uploaded */

if($photo != ""){

move_uploaded_file($_FILES['photo']['tmp_name'],
"photos/".$photo);

$sql = "UPDATE employees SET

name='$name',
department='$department',
phone='$phone',
email='$email',
address='$address',
emergency_contact='$emergency',
company_address='$company',
photo='$photo'

WHERE employeeid='$id'";

}
else{

$sql = "UPDATE employees SET

name='$name',
department='$department',
phone='$phone',
email='$email',
address='$address',
emergency_contact='$emergency',
company_address='$company'

WHERE employeeid='$id'";

}

mysqli_query($conn,$sql);

header("Location:dashboard.php");

?>