<?php
$servername = "devweb2023.cis.strath.ac.uk";
        $username = "tmb23194";
        $dbname = "tmb23194";
        $dbpassword = "Eihu5na6ongo";

        $conn = new mysqli($servername, $username, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
?>