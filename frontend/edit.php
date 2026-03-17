<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

include "../backend/db.php";

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM employees WHERE employeeid='$id'");
$row = mysqli_fetch_assoc($result);
?>
<link rel="stylesheet" href="style.css">

<div class="edit-page">

<div class="edit-card">

<h2>Edit Employee</h2>

<form method="POST" action="../backend/update.php" enctype="multipart/form-data">

<input type="hidden" name="employeeid"
value="<?php echo $row['employeeid']; ?>">

<div class="form-row">
<label>Name</label>
<input type="text" name="name" value="<?php echo $row['name']; ?>">
</div>

<div class="form-row">
<label>Department</label>
<input type="text" name="department" value="<?php echo $row['department']; ?>">
</div>

<div class="form-row">
<label>Phone</label>
<input type="text" name="phone" value="<?php echo $row['phone']; ?>">
</div>

<div class="form-row">
<label>Email</label>
<input type="text" name="email" value="<?php echo $row['email']; ?>">
</div>

<div class="form-row">
<label>Upload New Photo</label>
<input type="file" name="photo">
</div>

<div class="photo-box">
<p>Current Photo</p>
<img src="photos/<?php echo $row['photo']; ?>">
</div>

<div class="form-row">
<label>Address</label>
<input type="text" name="address" value="<?php echo $row['address']; ?>">
</div>

<div class="form-row">
<label>Emergency Contact</label>
<input type="text" name="emergency_contact" value="<?php echo $row['emergency_contact']; ?>">
</div>

<div class="form-row">
<label>Company Address</label>
<input type="text" name="company_address" value="<?php echo $row['company_address']; ?>">
</div>

<button class="update-btn">Update Employee</button>

</form>

</div>
</div>