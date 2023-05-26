<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('header.php');
require('../fpdf/fpdf.php');

if(!isset($_SESSION['admin_logged_in'])){

    header('location: login.php');
    exit;

}else if(isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $orders = $stmt->get_result();//array

    $stmt1 = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt1->bind_param("i", $order_id);
    $stmt1->execute();
    $order_items = $stmt1->get_result();//array

}else{
    header('location: orders.php');
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
$pdf->Cell(0	,5,'INVOICE',0,1,'C');
//invoice contents
$pdf->Cell(59	,10,'',0,1);//end of line
$pdf->SetFont('Arial','B',12);

$pdf->Cell(80	,5,'Product Name',1,0,'C');
$pdf->Cell(25	,5,'Price',1,0,'C');
$pdf->Cell(25	,5,'Color',1,0,'C');
$pdf->Cell(20	,5,'Quantity',1,0,'C');
$pdf->Cell(40	,5,'Total',1,1,'C');//end of line

$pdf->SetFont('Arial','',12);

//display the items
while($row = $order_items->fetch_assoc()){
	$pdf->Cell(80	,5,$row['product_name'],1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(25	,5,number_format($row['product_price']),1,0,'C');
    $pdf->Cell(25	,5,$row['product_color'],1,0,'C');
    $pdf->Cell(20	,5,number_format($row['product_quantity']),1,0,'C');
	$pdf->Cell(40	,5,number_format($row['product_price'] * $row['product_quantity']),1,1,'C');//end of line
}

while($row = $orders->fetch_assoc()){
$pdf->Cell(189	,5,'',0,1);
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(30	,5,'Shipping Fee',1,0);
$pdf->Cell(30	,5,number_format($row['shipping_fee']),1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(30	,5,'Subtotal',1,0);
$pdf->Cell(30	,5,number_format($row['order_cost']),1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(30	,5,'Total Due',1,0);
$pdf->Cell(30	,5,number_format($row['shipping_fee'] + $row['order_cost']),1,1,'R');//end of line
$pdf->Cell(189	,30,'',0,1);//end of line

//billing address

$pdf->SetFont('Arial','B',14);
$pdf->Cell(100	,5,'BILLED TO:',0,1,);//end of line

$pdf->SetFont('Arial','',12);
//add dummy cell at beginning of each line for indentation
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(35	,5,'Date:',0,0);
$pdf->Cell(34	,5,$row['order_date'],0,1);//end of line
$pdf->Cell(35	,5,'Order #:',0,0);
$pdf->Cell(24	,5,$row['order_id'],0,1);//end of line
$pdf->Cell(35	,5,'Customer ID:',0,0);
$pdf->Cell(25	,5,$row['user_id'],0,1);//end of line
$pdf->Cell(35	,5,'Customer Name:',0,0);
$pdf->Cell(90	,5,$row['user_name'],0,1);
$pdf->Cell(35	,5,'Address:',0,0);
$pdf->Cell(90	,5,$row['user_address'],0,1);
$pdf->Cell(35	,5,'Landmark:',0,0);
$pdf->Cell(90	,5,$row['user_landmark'],0,1);
$pdf->Cell(35	,5,'Contact:',0,0);
$pdf->Cell(90	,5,$row['user_phone'],0,1);

}

$file_location = "/xampp/htdocs/bikeshop-ims/pdf/";
$datetime = date('dmY_hms');
$file_name = "Invoice_".$datetime.".pdf";


if($_GET['ACTION']=='VIEW'){

    $pdf->Output($file_name, 'I'); 

}else if($_GET['ACTION']=='UPLOAD'){

    $pdf->Output($file_location.$file_name, 'F');
    header('location: invoice.php?invoice_uploaded=Invoice has been uploaded successfully!');
	exit;

}else if($_GET['ACTION']=='DOWNLOAD'){

    $pdf->Output($file_name, 'D'); 

}else if($_GET['ACTION']=='EMAIL'){

    require ('../vendor/autoload.php');

    $order_id = $_GET['order_id'];

    $stmt = $conn->prepare('SELECT * FROM orders WHERE order_id=?');
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $orders = $stmt->get_result();

    $pdf->Output($file_location.$file_name, 'F');

    while($row = $orders->fetch_assoc()) {

        $user_name = $row['user_name'];
        $body = '';
        $body .="<html>
        <head>
        <style type='text/css'> 
        body {
        font-family: Calibri;
        font-size:16px;
        color:#000;
        }
        </style>
        </head>
        <body>
        Dear $user_name,
        <br>
        <br>
        Please find attached invoice copy.
        <br>
        <br>
        Thank you!
        </body>
        </html>";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'itcapstone2023@gmail.com';                     //SMTP username
        $mail->Password   = 'oxgbjeygudtqlyog';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('itcapstone2023@gmail.com', 'Vykes MNL');
        $mail->addAddress($row['user_email'], $user_name);     //Add a recipient
        $mail->addReplyTo('itcapstone2023@gmail.com', 'Vykes MNL');

        //Attachments
        $mail->addAttachment($file_location.$file_name);         //Add attachments

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Vykes MNL Order Invoice';
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        header('location: invoice.php?invoice_sent=Invoice has been emailed successfully!');
        exit; 
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}
}else{
	echo "Record not found for PDF.";
}



?>