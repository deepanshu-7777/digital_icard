<?php

include "db.php";

/* ===== GET FORM DATA ===== */

$id        = $_POST['employeeid'];
$name      = $_POST['name'];
$department= $_POST['department'];
$phone     = $_POST['phone'];
$email     = $_POST['email'];
$address   = $_POST['address'];
$emergency = $_POST['emergency_contact'];
$company   = $_POST['company_address'];

/* ===== BASIC VALIDATION ===== */

if(empty($id)){
    die("Employee ID is required.");
}

/* ===== PHOTO UPLOAD ===== */

$photo = $_FILES['photo']['name'];

$photoFolder = "../frontend/photos/";

if(!file_exists($photoFolder)){
    mkdir($photoFolder,0777,true);
}

$photoPath = $photoFolder.$photo;

move_uploaded_file($_FILES['photo']['tmp_name'],$photoPath);

/* Store relative path in DB */
$photo_db = "photos/".$photo;


/* ===== QR GENERATION ===== */

$qrFolder = "../frontend/qr/";

if(!file_exists($qrFolder)){
    mkdir($qrFolder,0777,true);
}

$qrFileName = $id.".png";
$qrFullPath = $qrFolder.$qrFileName;

/* Data to encode in QR */
$qrdata = "http://localhost/employee_card/frontend/card.php?id=".$id;

/* Generate QR using API */
file_put_contents(
    $qrFullPath,
    file_get_contents(
        "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=".urlencode($qrdata)
    )
);

/* Store relative path in DB */
$qr_db = "qr/".$qrFileName;


/* ===== INSERT INTO DATABASE ===== */

mysqli_query($conn,"INSERT INTO employees
(employeeid,name,department,phone,email,qr,photo,address,emergency_contact,company_address,status)

VALUES('$id','$name','$department','$phone','$email','$qr_db','$photo_db','$address','$emergency','$company','active')");


/* ===== REDIRECT ===== */

header("Location:../frontend/dashboard.php");
exit();

?>