<?php 
include('header.php');
?>
<?php

if(!isset($_SESSION['logged_in'])){

    header('location: ../login.php');
    exit;

}else if($_SESSION['user_type'] == 'employee'){

    http_response_code(404);
    include('my_404.php'); // provide your own HTML for the error page
    die();

}else if($_SESSION['user_type'] == 'user'){

    http_response_code(404);
    include('my_404.php'); // provide your own HTML for the error page
    die();

}else{

    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
        $stmt->bind_param('i', $user_id);
        
        if($stmt->execute()){

            header('location: account.php?delete_success_message=Account has been deleted successfully!');

        }else{

            header('location: account.php?delete_failure_message=Account could not be deleted.');
            
        }

        
    }
}
?>
