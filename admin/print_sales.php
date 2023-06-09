<?php

include('header.php');
include('security.php');
require('../fpdf/fpdf.php');

if(!isset($_SESSION['logged_in'])){

    header('location: ../login.php');
    exit;

}else{

    $stmt = $conn->prepare("SELECT orders.user_name, orders.order_date, order_items.product_name, order_items.product_color, order_items.product_id, order_items.product_price, order_items.product_quantity, orders.payment_method, orders.shipping_method, products.product_bp FROM orders INNER JOIN order_items ON orders.order_id = order_items.order_id
    INNER JOIN products ON order_items.product_id = products.product_id WHERE DATE(orders.order_date) = curdate() ORDER BY orders.order_date DESC");
    $stmt->execute();
    $orders = $stmt->get_result();//array

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
        $this->Line(0,48,297,48);
        //make a dummy empty cell as a vertical spacer
        //Cell(width , height , text , border , end line , [align] )
        $this->Cell(189	,20,'',0,1);//end of line
        $this->SetFont('Arial','B',18);
        $this->Cell(0	,5,'Sales Report',0,1,'C');
        //invoice contents
        $this->Cell(59	,10,'',0,1);//end of line
        $this->SetFont('Arial','B',8);
        $this->Cell(25	,5,'Date',1,0,'C');
        $this->Cell(55	,5,'Product Name',1,0,'C');
        $this->Cell(55	,5,'Customer Name',1,0,'C');
        $this->Cell(20	,5,'Price',1,0,'C');
        $this->Cell(10	,5,'QTY',1,0,'C');
        $this->Cell(25	,5,'Total Cost',1,0,'C');
        $this->Cell(45	,5,'MOP',1,0,'C');
        $this->Cell(20	,5,'Base Price',1,0,'C');
        $this->Cell(23	,5,'Gross Income',1,1,'C');
        
    }
}

$pdf = new PDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','',8);

//display the items
while($row = $orders->fetch_assoc()){

    $total = $row['product_price'] * $row['product_quantity'];
    $sub_total_gross = ($row['product_price'] - $row['product_bp']) * $row['product_quantity'];
    $main_total += $sub_total_gross;
    
	$pdf->Cell(25	,5,$row['order_date'],1,0,'C');
	//add thousand separator using number_format function
    $pdf->Cell(55	,5,$row['product_name'],1,0,'C');
    $pdf->Cell(55	,5,$row['user_name'],1,0,'C');
    $pdf->Cell(20	,5,number_format($row['product_price'],2),1,0,'C');
    $pdf->Cell(10	,5,number_format($row['product_quantity']),1,0,'C');//end of line
	$pdf->Cell(25	,5,number_format($total,2),1,0,'C');
    $pdf->Cell(45	,5,$row['payment_method'],1,0,'C');
    $pdf->Cell(20	,5,number_format($row['product_bp'],2),1,0,'C');
    $pdf->Cell(23	,5,number_format($sub_total_gross,2),1,1,'C');
    
	
}   
   
    $pdf->Cell(235	,5,'',0,0);
    $pdf->Cell(43	,5,'Total Gross Income:',1,1,'C');
    $pdf->Cell(235	,5,'',0,0);
    $pdf->Cell(43	,5,number_format($main_total,2),1,1,'C');

$file_location = "/xampp/htdocs/bikeshop-ims/pdf/stock-report/";
$datetime = date('dmY_hms');
$file_name = "Stock-Report_".$datetime.".pdf";

$pdf->Output($file_name, 'I'); 

?>