<?php

include "db.php";
require('fpdf/fpdf.php');

$id=$_GET['id'];

$result=mysqli_query($conn,
"SELECT * FROM employees WHERE employeeid='$id'");

$row=mysqli_fetch_assoc($result);

$pdf=new FPDF();
$pdf->AddPage();


/* ========= CONTAINER GAP ========= */
/* 50px ≈ 15mm */

$pad = 15;

$width  = 210 - ($pad*2);
$height = 297 - ($pad*2);


/* ========= MAIN CONTAINER ========= */

$pdf->SetFillColor(255,255,255);

$pdf->Rect($pad,$pad,$width,$height,'F');



/* ========= HEADER BLUE ========= */

$headerHeight=55;

$pdf->SetFillColor(28,105,170);

$pdf->Rect($pad,$pad,$width,$headerHeight,'F');



/* ========= LOGO BOX CENTER ========= */

$logoWidth=80;
$logoHeight=28;

$logoX=$pad+($width/2)-($logoWidth/2);
$logoY=$pad;

$pdf->SetFillColor(255,255,255);

$pdf->Rect(
$logoX,
$logoY,
$logoWidth,
$logoHeight,
'F'
);



/* ========= LOGO ========= */

$pdf->Image(
"photos/omaxe_logo.jpeg",
$logoX+5,
$logoY+6,
70
);



/* ========= TITLE ========= */
/* 15px top & bottom spacing */

$pdf->SetTextColor(255,255,255);

$pdf->SetFont("Arial","B",28);

$titleY=$logoY+$logoHeight+7;

$pdf->SetXY($pad,$titleY);

$pdf->Cell($width,12,
"EMPLOYEE ID CARD",
0,1,"C");



/* ========= DETAILS AREA ========= */

$detailsHeight=70;

$detailsY=$pad+$headerHeight;

$pdf->SetFillColor(255,255,255);

$pdf->Rect(
$pad,
$detailsY,
$width,
$detailsHeight,
'F'
);



/* ========= DETAILS TEXT ========= */

$pdf->SetTextColor(0,0,0);

$pdf->SetFont("Arial","B",17);

$pdf->SetXY($pad,$detailsY+20);

$pdf->Cell($width,10,
"Employee Code: ".$row['employeeid'],
0,1,"C");

$pdf->Cell($width,10,
"Name: ".$row['name'],
0,1,"C");

$pdf->Cell($width,10,
"Department: ".$row['department'],
0,1,"C");



/* ========= QR BLUE AREA ========= */

$qrY=$detailsY+$detailsHeight;

$pdf->SetFillColor(28,105,170);

$pdf->Rect(
$pad,
$qrY,
$width,
$height-$headerHeight-$detailsHeight,
'F'
);



/* ========= QR TEXT ========= */

$pdf->SetTextColor(255,255,255);

$pdf->SetFont("Arial","B",16);

$pdf->SetXY($pad,$qrY+10);

$pdf->Cell($width,10,
"For More Information, Please Scan The QR Code.",
0,1,"C");



/* ========= QR BORDER ========= */

$qrBoxSize=82;

$qrBoxX=$pad+($width/2)-($qrBoxSize/2);

$qrBoxY=$qrY+25;


$pdf->SetFillColor(255,255,255);

$pdf->Rect(
$qrBoxX,
$qrBoxY,
$qrBoxSize,
$qrBoxSize,
'F'
);



/* ========= QR CODE ========= */

$pdf->Image(
$row['qr'],
$qrBoxX+6,
$qrBoxY+6,
70
);



/* ========= WEBSITE ========= */

$pdf->SetFillColor(255,255,255);

$pdf->Rect(
$pad+($width/2)-45,
$qrBoxY+103,
90,
10,
'F'
);


$pdf->SetTextColor(0,0,0);

$pdf->SetFont("Arial","B",16);

$pdf->SetXY(
$pad+($width/2)-45,
$qrBoxY+101
);

$pdf->Cell(90,10,
"www.omaxe.com",
0,1,"C");



$pdf->Output("D",$row['employeeid']."_card.pdf");

?>