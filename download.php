<?php

include "db.php";

require('fpdf/fpdf.php');

$id=$_GET['id'];

$result=mysqli_query($conn,
"SELECT * FROM employees WHERE employeeid='$id'");

$row=mysqli_fetch_assoc($result);
$pdf=new FPDF();

$pdf->AddPage();

/* Logo */

$pdf->Image("photos/omaxe_logo.jpeg",70,10,60);

$pdf->Ln(35);

/* Title */

$pdf->SetFont("Arial","B",16);

$pdf->Cell(190,10,"OMAXE Employee ID Card",0,1,"C");

$pdf->Ln(10);

/* Employee Details Centered */

$pdf->SetFont("Arial","",12);

$pdf->Cell(190,10,"Employee ID: ".$row['employeeid'],0,1,"C");

$pdf->Cell(190,10,"Name: ".$row['name'],0,1,"C");

$pdf->Cell(190,10,"Department: ".$row['department'],0,1,"C");

$pdf->Ln(10);

/* QR Code Center */

$pdf->Image($row['qr'],80,120,50);

$pdf->Output("D",$row['employeeid']."_card.pdf");
// $pdf->Cell(50,10,"Phone:");
// $pdf->Cell(100,10,$row['phone'],0,1);

// $pdf->Cell(50,10,"Email:");
// $pdf->Cell(100,10,$row['email'],0,1);

// $pdf->Ln(10);

// /* Photo */

// $pdf->Image("photos/".$row['photo'],10,80,30);

/* QR Code */

// $pdf->Image($row['qr'],150,80,40);

// // $pdf->Cell(50,10,"company address:");
// // $pdf->Cell(100,10,$row['company_address'],0,1);

// $pdf->Output("D",$row['employeeid']."_card.pdf");

// ?>