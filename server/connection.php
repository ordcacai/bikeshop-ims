<?php
        $host = 'srv598.hstgr.io'; // Replace with your MySQL server hostname or IP address
        $db = 'u564301412_inventory_db'; // Replace with your database name
        $user = 'u564301412_inventory_db'; // Replace with your MySQL username
        $password = 'Gw*8ZG2I'; // Replace with your MySQL password

        // Create a connection
        $conn = new mysqli($host, $user, $password, $db);

        // Check the connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        echo "Connected successfully";

        // Close the connection
        $conn->close();
?>
