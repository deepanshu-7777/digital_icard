<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:admin_login.php");
    exit();
}
?>

<link rel="stylesheet" href="style.css">

<div class="edit-page">

<div class="edit-card">

<h2>Upload Employee CSV</h2>

<form method="POST" action="../backend/import.php" enctype="multipart/form-data">

<div class="form-row">
<label>Select CSV File</label>
<input type="file" name="file" accept=".csv" required>
</div>

<button class="update-btn">Upload CSV</button>

</form>

</div>

</div>