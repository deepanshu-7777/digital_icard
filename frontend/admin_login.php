<?php
session_start();

if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit();
}

include "../backend/db.php";
?>

<html>

<head>

<title>Admin Login</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="login-box">

<h2>Admin Login</h2>
<h3>Employee Management System</h3>

<form action="../backend/admin_check.php" method="POST">

<input type="text"
name="username"
placeholder="Enter Username"
required>

<input type="password"
name="password"
placeholder="Enter Password"
required>

<br>

<button type="submit">

Login

</button>

</form>

</div>

</body>

</html>