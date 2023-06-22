<?php

include('header.php');
include('security.php');
require('../fpdf/fpdf.php');

if(!isset($_SESSION['logged_in'])){

    header('location: ../login.php');
    exit;

}else{

    $stmt = $conn->prepare("SELECT * FROM stock_transfer WHERE transfer_type = 'Inbound' AND DATE(transfer_date) = curdate()");
    $stmt->execute();
    $stocks = $stmt->get_result();//array

}

class PDF extends FPDF{

    function header(){
        $this->Image('../assets/imgs/logo.jpg',10,10,25,25,'JPG', $link ='https://vykesmnl.com/login.php');
        $this->SetFont('Arial','B',14);
        $this->Cell(0	,5,'Vykes MNL',0,0,'R');

        //set font to arial, regular, 12pt
        $this->SetFont('Arial','',12);
        $this->Cell(0	,10,'',0,1);//end of line

        $this->Cell(0	,5,'59C Gen Ordonez Ave ',0,1,'R');
        $this->Cell(0	,5,'Marikina City, Philippines, 1800',0,1,'R');
        $this->Cell(0	,5,'Phone No. +63 9562256879',0,1,'R');
        $this->Cell(0	,5,'Fax [+12345678]',0,1,'R');
        $this->Line(0,48,210,48);
        //make a dummy empty cell as a vertical spacer
        $this->Cell(189	,20,'',0,1);//end of line
    }
}

$pdf = new PDF('P','mm','A4');

$pdf->AddPage();

//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0	,5,'Inbound Report',0,1,'C');
//invoice contents
$pdf->Cell(59	,10,'',0,1);//end of line
$pdf->SetFont('Arial','B',12);

$pdf->Cell(25	,5,'Product ID',1,0,'C');
$pdf->Cell(80	,5,'Product Name',1,0,'C');
$pdf->Cell(35	,5,'Color & Size',1,0,'C');
$pdf->Cell(25	,5,'Quantity',1,0,'C');
$pdf->Cell(25	,5,'From',1,1,'C');//end of line

$pdf->SetFont('Arial','',12);

//display the items
while($row = $stocks->fetch_assoc()){
	//add thousand separator using number_format function
	$pdf->Cell(25	,5,number_format($row['product_id']),1,0,'C');
    $pdf->Cell(80	,5,$row['product_name'],1,0,'C');
    $pdf->Cell(35	,5,$row['color_size'],1,0,'C');
	$pdf->Cell(25	,5,number_format($row['quantity']),1,0,'C');
    $pdf->Cell(25	,5,$row['location_from'],1,1,'C');
    //end of line
}

$file_location = "/xampp/htdocs/bikeshop-ims/pdf/stock-report/";
$datetime = date('dmY_hms');
$file_name = "Inbound-Report_".$datetime.".pdf";

$pdf->Output($file_name, 'I'); 

?>