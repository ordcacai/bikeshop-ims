<?php
        $host = 'localhost'; 
        $db = 'u564301412_vmnl_db'; 
        $user = 'u564301412_vmnl_db'; 
        $password = 'VykesMNL2023'; 

        // Create a connection
        $conn = new mysqli($host, $user, $password, $db);

        // Check the connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
?>