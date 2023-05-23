<?php
        $host = '31.220.110.201'; // Replace with your MySQL server hostname or IP address
        $db = 'u564301412_inventory_db'; // Replace with your database name
        $user = 'u564301412_inventory_db'; // Replace with your MySQL username
        $password = 'VykesMNL23'; // Replace with your MySQL password

        // Create a connection
        $conn = new mysqli($host, $user, $password, $db);

        // Check the connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
?>
