<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('layouts/header.php');
include('server/connection.php');

if(!isset($_SESSION['logged_in'])){

    header('location: login.php');
    exit;

}else if(isset($_POST['cancel_order_btn'])){

    require ('vendor/autoload.php');
    require ('admin/credential.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $order_id = $_POST['order_id'];
    $message = $_POST['message'];


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
        .center {
            padding: 10px;
            text-align: center;
          }
        </style>
        </head>
        <body>
        <h1 class='center'>Order ID: $order_id</h1>
        <div >
        <p>$message</p>
        </div>
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
        $mail->Username   = EMAIL;                     //SMTP username
        $mail->Password   = PASS;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress(EMAIL, 'Vykes MNL');     //Add a recipient
        $mail->addReplyTo($email, $name);

        //Attachments
        // $mail->addAttachment($file_location.$file_name);         //Add attachments

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Cancel Order Request: '.$subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        $mail->send();
        header('location: cancel_order.php?request_sent=Email sent successfully!');
        exit; 
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}else{
    header('location: cancel_order.php?request_failed=Cancel order request unsuccessful.');
}
?>