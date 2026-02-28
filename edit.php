<?php
include "db.php";

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM employees
WHERE employeeid='$id'");

$row=mysqli_fetch_assoc($result);
?>

<form method="POST" action="update.php" enctype="multipart/form-data">

<input type="hidden" name="employeeid"
value="<?php echo $row['employeeid']; ?>">

Name:
<input type="text" name="name"
value="<?php echo $row['name']; ?>"><br>

Department:
<input type="text" name="department"
value="<?php echo $row['department']; ?>"><br>

Phone:
<input type="text" name="phone"
value="<?php echo $row['phone']; ?>"><br>

Email:
<input type="text" name="email"
value="<?php echo $row['email']; ?>"><br>

Photo:
<input type="file" name="photo"><br>

Current Photo:
<img src="photos/<?php echo $row['photo']; ?>" width="80">

Address:
<input type="text" name="address"
value="<?php echo $row['address']; ?>"><br>

Emergency Contact:
<input type="text" name="emergency_contact"
value="<?php echo $row['emergency_contact']; ?>"><br>

Company Address:
<input type="text" name="company_address"
value="<?php echo $row['company_address']; ?>"><br>

<input type="submit" value="Update">

</form>