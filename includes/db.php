<?php 
// CONSTANTS
    // HOST SERVER:
    define("SERVER","localhost");
    // ADMINISTRATOR USERNAME:
    define("ADMIN_NAME","root");
    // ADMINISTRATOR PASSWORD:
    define("ADMIN_PASS","");
    // DATABASE NAME:
    define("DB_NAME","cms");

    $connection = mysqli_connect(SERVER,ADMIN_NAME,ADMIN_PASS,DB_NAME);
    
    // Checks if $connection exists; if not, throws error. 
    if (!$connection) {
        die("Database Connection Failed!");
    } 

?>