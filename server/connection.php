<?php
        $host = '31.220.110.201'; 
        $db = 'u564301412_inventory_db'; 
        $user = 'u564301412_inventory_db'; 
        $password = 'VykesMNL23'; 

        // Create a connection
        $conn = new mysqli($host, $user, $password, $db);

        // Check the connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
?>
