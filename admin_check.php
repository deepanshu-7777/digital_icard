<?php

session_start();
include "db.php";

$username=$_POST['username'];
$password=$_POST['password'];

$result=mysqli_query($conn,"SELECT * FROM admin
WHERE username='$username' AND password='$password'");

$row=mysqli_fetch_assoc($result);

if($row){

$_SESSION['admin']=$username;

header("Location:dashboard.php");

}
else{

echo "Login Failed";

}

?>