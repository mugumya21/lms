<?php 
include('db_connect.php');
require('./fpdf/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->setFont('Arial', 'B', 20);


$pdf->Cell(71,10,'',0,0);
$pdf->Cell(59,5,'Receipt',0,0);
$pdf->Cell(59,10,'',0,1);


$pdf->setFont('Arial', 'B', 15);

$pdf->Cell(71,5,'',0,0);
$pdf->Cell(59,5,'Wet',0,0);
$pdf->Cell(59,5,'Details',0,1);


$pdf->setFont('Arial', '', 10);




$pdf->Cell(130,5,'Near Dav',0,0);
$pdf->Cell(25,5,'Customer Name',0,0);
$pdf->Cell(34,5,'Mugumya Vicent',0,1);

$pdf->Cell(130,5,'',0,0);
$pdf->Cell(25,5,'Receipt No',0,0);
$pdf->Cell(34,5,'09th August, 2024',0,1);


$pdf->setFont('Arial', 'B', 15);


$pdf->Cell(130,5,'Bill To',0,0);
$pdf->Cell(59,5,'',0,0);

$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(34,5,'',0,1);
 

$pdf->setFont('Arial', '', 12);

        $laundry_lists = "SELECT S.*, S.name as sname, St.*, St.name as stname,  L.paid , L.total_quantity FROM laundry_lists L INNER JOIN suppliers S ON L.supplier_id = S.id  INNER JOIN laundry_statuses St ON L.status = St.id" ;
        
        $result = $conn->query($laundry_lists);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(50,10, $row['total_quantity'],1,0);
    $pdf->Cell(50,10, $row['total_quantity'],1,0);
    $pdf->Cell(50,10, $row['total_quantity'],1,1);
}

$pdf->Output();
?>
