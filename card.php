<?php

include "db.php";

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM employees WHERE employeeid='$id'");

$row=mysqli_fetch_assoc($result);

// check if card is hidden
if($row['status'] == "hidden"){
    echo "Card Not Available";
    exit();
}

?>

<center>

<div style="width:350px;
border:2px solid black;
padding:20px;
border-radius:15px;
text-align:center;
font-family:Arial;">


<!-- Company Logo -->

<img src="photos/omaxe_logo.jpeg"
style="width:120px;
display:block;
margin:auto;
margin-bottom:10px;">


<!-- Employee Photo -->

<img src="photos/<?php echo $row['photo']; ?>"
width="120"
style="border-radius:50%;
display:block;
margin:auto;
margin-bottom:10px;">


<h3><?php echo $row['name']; ?></h3>

<p><b>ID:</b> <?php echo $row['employeeid']; ?></p>

<p><b>Department:</b> <?php echo $row['department']; ?></p>

<p><b>Phone:</b> <?php echo $row['phone']; ?></p>

<p><b>Email:</b> <?php echo $row['email']; ?></p>

<p><b>Address:</b>
<?php echo $row['address']; ?></p>

<p><b>Emergency Contact:</b>
<?php echo $row['emergency_contact']; ?></p>

<p><b>Company Address:</b>
<?php echo $row['company_address']; ?></p>
<!-- QR Code -->

<img src="<?php echo $row['qr']; ?>"
width="150"
style="margin-top:10px;">

</div>


<br>

<a href="download.php?id=<?php echo $row['employeeid']; ?>">
<button>Download Card</button>
</a>

</center>