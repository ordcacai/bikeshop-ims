<?php

if($_SESSION['user_type']=='user'){
    
    http_response_code(404);
    include('my_404.php'); // provide your own HTML for the error page
    die();
    // echo 'tanginamo bypass pa';
    // header('location: ../index.php');
    // exit;
}else{

}
?>