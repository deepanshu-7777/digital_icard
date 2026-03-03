<?php

include "db.php";
require('fpdf/fpdf.php');

$id=$_GET['id'];

$result=mysqli_query($conn,
"SELECT * FROM employees WHERE employeeid='$id'");

$row=mysqli_fetch_assoc($result);

$pdf=new FPDF();
$pdf->AddPage();


/* ========= CONTAINER SETTINGS ========= */

$pad = 10;

$width  = 210 - ($pad*2);
$height = 297 - ($pad*2);



/* ========= SHADOW (30px Light Gray) ========= */
/* 30px ≈ 10mm */

$pdf->SetFillColor( 220,220,220);

/* Outer shadow */
$pdf->Rect(
$pad-5,
$pad-5,
$width+10,
$height+10,
'F'
);


/* Soft shadow layer */

$pdf->SetFillColor(235,235,235);

$pdf->Rect(
$pad-3,
$pad-3,
$width+6,
$height+6,
'F'
);



/* ========= MAIN CONTAINER ========= */

$pdf->SetFillColor(255,255,255);

/* Border + Fill */

$pdf->Rect(
$pad,
$pad,
$width,
$height,
'DF'
);


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


/* ===== WEBSITE BOX (20px TOP MARGIN) ===== */

  // 20px ≈ 7mm
$marginTop = 0; 

/* TEXT COLOR WHITE */

$pdf->SetTextColor(255,255,255);

$pdf->SetFont("Arial","B",16);

$pdf->SetXY(
$pad+($width/2)-45,
$qrBoxY+101+$marginTop
);

$pdf->Cell(
90,
10,
"www.omaxe.com",
0,
1,
"C"
);

$pdf->Output("D",$row['employeeid']."_card.pdf");

?>