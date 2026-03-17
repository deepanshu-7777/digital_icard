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

if(isset($_FILES['photo'])){

    $error = $_FILES['photo']['error'];

    if($error !== 0){
        $error_messages = array(
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
            3 => 'The uploaded file was only partially uploaded.',
            4 => 'No file was uploaded.',
            6 => 'Missing a temporary folder.',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.'
        );
        die("Upload error: " . (isset($error_messages[$error]) ? $error_messages[$error] : "Unknown error ($error)"));
    }

    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_size = $_FILES['photo']['size'];
    $photo_type = $_FILES['photo']['type'];

    // Validate file type (only images)
    $allowed_types = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
    if(!in_array($photo_type, $allowed_types)){
        die("Error: Only JPG, PNG, and GIF files are allowed. Uploaded type: $photo_type");
    }

    // Validate file size (max 5MB)
    if($photo_size > 5242880){
        die("Error: File size must be less than 5MB. Uploaded size: " . ($photo_size / 1024 / 1024) . "MB");
    }

    $photoFolder = "../frontend/photos/";

    if(!file_exists($photoFolder)){
        mkdir($photoFolder, 0777, true);
    }

    // Generate unique filename to prevent conflicts
    $photo_ext = pathinfo($photo, PATHINFO_EXTENSION);
    $photo_new_name = $id . "_" . time() . "." . $photo_ext;
    $photoPath = $photoFolder . $photo_new_name;

    if(move_uploaded_file($photo_tmp, $photoPath)){
        /* Store filename only in DB (display code adds photos/ prefix) */
        $photo_db = $photo_new_name;
    } else {
        die("Error: Failed to upload photo.");
    }

} else {
    die("Error: Please select a photo to upload.");
}


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

$query = "INSERT INTO employees
(employeeid,name,department,phone,email,qr,photo,address,emergency_contact,company_address,status)
VALUES('$id','$name','$department','$phone','$email','$qr_db','$photo_db','$address','$emergency','$company','active')";

if(mysqli_query($conn, $query)){
    /* ===== REDIRECT ===== */
    header("Location:../frontend/dashboard.php");
    exit();
} else {
    die("Error: Failed to save employee data. " . mysqli_error($conn));
}

?>