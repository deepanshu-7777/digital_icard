<?php

session_start();

if(!isset($_SESSION['admin'])){

header("Location:admin_login.php");

}

include "../backend/db.php";

?>
<form method="POST" action="../backend/import.php" enctype="multipart/form-data">

Upload CSV File:

<input type="file" name="file">

<input type="submit" value="Upload">

</form>