<?php
session_start();

if(!isset($_SESSION['admin'])){
header("Location:admin_login.php");
}

include "db.php";
?>

<link rel="stylesheet" href="style.css">

<div class="container">

<h2>Admin Dashboard</h2>

<div class="navbar">

<a href="add_employee.php">Add Employee</a>

<a href="upload.php">Upload CSV</a>

<a href="logout.php">Logout</a>

</div>

<br>

<!-- Search Box -->

<div class="search-box">

<form method="GET" action="dashboard.php">

<input type="text"
name="search"
placeholder="Enter ID or Name">

<button type="submit">Search</button>

<a href="dashboard.php">Reset</a>

</form>

</div>

<br>

<table border="1" cellpadding="10">

<tr>

<th>ID</th>
<th>Photo</th>
<th>Name</th>
<th>Department</th>
<th>Phone</th>
<th>Email</th>
<th>Address</th>
<th>Emergency</th>
<th>Company Address</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php

/* Search Query */

if(isset($_GET['search'])){

$search=$_GET['search'];

$result=mysqli_query($conn,"SELECT * FROM employees
WHERE employeeid LIKE '%$search%'
OR name LIKE '%$search%'");

}
else{

$result=mysqli_query($conn,"SELECT * FROM employees");

}

/* Display Employees */

while($row=mysqli_fetch_assoc($result)){

echo "<tr>";

echo "<td>".$row['employeeid']."</td>";

echo "<td>
<img class='photo'
src='photos/".$row['photo']."'>
</td>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['department']."</td>";

echo "<td>".$row['phone']."</td>";

echo "<td>".$row['email']."</td>";

echo "<td>".$row['address']."</td>";

echo "<td>".$row['emergency_contact']."</td>";

echo "<td>".$row['company_address']."</td>";

/* Status */

if($row['status']=="active"){

echo "<td class='active-status'>Active</td>";

}
else{

echo "<td class='hidden-status'>Hidden</td>";

}

/* Action Buttons */

if($row['status']=="active"){

echo "<td class='action-buttons'>

<a class='btn edit'
href='edit.php?id=".$row['employeeid']."'>Edit</a>

<a class='btn hide'
href='hide.php?id=".$row['employeeid']."'>Hide</a>

<a class='btn download'
href='download.php?id=".$row['employeeid']."'>Download</a>

</td>";

}

else{

echo "<td class='action-buttons'>

<a class='btn edit'
href='edit.php?id=".$row['employeeid']."'>Edit</a>

<a class='btn active'
href='active.php?id=".$row['employeeid']."'>Active</a>

<a class='btn download'
href='download.php?id=".$row['employeeid']."'>Download</a>

</td>";

}

echo "</tr>";

}

?>

</table>

</div>