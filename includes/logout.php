<?php 
$user = null; 
session_start();

$_SESSION[ 'username' ] = null;
$_SESSION[ 'fname' ]    = null;
$_SESSION[ 'lname' ]    = null;
$_SESSION[ 'role' ]     = null;

header("Location: ../index.php");

?>