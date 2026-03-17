<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:admin_login.php");
    exit();
}

include "../backend/db.php";
?>

<link rel="stylesheet" href="style.css">

<div class="edit-page">

<div class="edit-card">

<h2>Add Employee</h2>

<form method="POST" action="../backend/save_employee.php" enctype="multipart/form-data">

<div class="form-row">
<label>Employee ID</label>
<input type="text" name="employeeid" required>
</div>

<div class="form-row">
<label>Name</label>
<input type="text" name="name" required>
</div>

<div class="form-row">
<label>Department</label>
<input type="text" name="department" required>
</div>

<div class="form-row">
<label>Phone</label>
<input type="text" name="phone" required>
</div>

<div class="form-row">
<label>Email</label>
<input type="email" name="email" required>
</div>

<div class="form-row">
<label>Upload Photo</label>
<input type="file" name="photo" required>
</div>

<div class="form-row">
<label>Address</label>
<input type="text" name="address">
</div>

<div class="form-row">
<label>Emergency Contact</label>
<input type="text" name="emergency_contact">
</div>

<div class="form-row">
<label>Company Address</label>
<input type="text" name="company_address">
</div>

<button class="update-btn">Save Employee</button>

</form>

</div>

</div>