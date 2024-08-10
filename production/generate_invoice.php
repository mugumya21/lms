<?php 
include('db_connect.php');

require('./fpdf/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();
$pdf->setFont('Arial', 'B', 20);
$pdf->Cell(71,10,'',0,0);
$pdf->Cell(59,5,'Invoice',0,0);
$pdf->Cell(59,10,'',0,1);



 $pdf->Output();
?>