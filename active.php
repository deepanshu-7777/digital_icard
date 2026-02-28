<?php

include "db.php";

$id=$_GET['id'];

mysqli_query($conn,"UPDATE employees
SET status='active'
WHERE employeeid='$id'");

header("Location:dashboard.php");

?>