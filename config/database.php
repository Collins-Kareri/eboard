<?php
    //enter database details.
    
    define("DB_HOST", "yourhost");
    define("DB_USERNAME", "youruser");
    define("DB_PASSWORD", "yourpassword");
    define("DB_NAME", "yourdatabase");

    //create connection to database
    $conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

    //check database connection

    if($conn->connect_error){
        die("Connection Failed " . $conn->connect_error);
    }
?>