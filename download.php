<?php

include "db.php";

require('fpdf/fpdf.php');

$id=$_GET['id'];

$result=mysqli_query($conn,
"SELECT * FROM employees WHERE employeeid='$id'");

$row=mysqli_fetch_assoc($result);

$pdf=new FPDF();

$pdf->AddPage();

/* Company Logo */

$pdf->Image("photos/omaxe_logo.jpeg",70,10,60);

/* Move Cursor Down */

$pdf->Ln(35);

/* Company Name */

$pdf->SetFont("Arial","B",16);

$pdf->Cell(190,10,"OMAXE Employee ID Card",0,1,"C");

$pdf->Ln(10);

$pdf->SetFont("Arial","",12);

$pdf->Cell(50,10,"Employee ID:");
$pdf->Cell(100,10,$row['employeeid'],0,1);

 $pdf->Cell(50,10,"Name:");
$pdf->Cell(100,10,$row['name'],0,1);

$pdf->Cell(50,10,"Department:");
$pdf->Cell(100,10,$row['department'],0,1);

// $pdf->Cell(50,10,"Phone:");
// $pdf->Cell(100,10,$row['phone'],0,1);

// $pdf->Cell(50,10,"Email:");
// $pdf->Cell(100,10,$row['email'],0,1);

// $pdf->Ln(10);

// /* Photo */

// $pdf->Image("photos/".$row['photo'],10,80,30);

/* QR Code */

$pdf->Image($row['qr'],150,80,40);

// $pdf->Cell(50,10,"company address:");
// $pdf->Cell(100,10,$row['company_address'],0,1);

$pdf->Output("D",$row['employeeid']."_card.pdf");

?>