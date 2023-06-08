<?php
        $host = '31.220.110.201';
        $db = 'u564301412_vmnl_db';
        $user = 'u564301412_vmnl_db';
        $password = 'rX^raBl57';

        // Create connection 
        $conn = new mysqli($host, $user, $password, $db);

        // Check connection
        if ($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
        }

?>