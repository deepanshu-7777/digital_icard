<?php

session_start();

if(!isset($_SESSION['admin'])){

header("Location:admin_login.php");

}

?>
<form method="POST" action="import.php" enctype="multipart/form-data">

Upload CSV File:

<input type="file" name="file">

<input type="submit" value="Upload">

</form>