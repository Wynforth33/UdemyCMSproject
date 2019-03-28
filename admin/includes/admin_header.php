<?php 
    include "../includes/constants.php"; 
    include "../includes/functions.php"; 

  // In Charge of Buffering Requests in the headers of scripts so that when done 
  // with scripts it will send everything at one time rather than one at a time  
    ob_start();
    
    session_start();

    $logged_in = null;

  // CHECKS IF SESSION_ID HAS BEEN SET (SHOULD BE SET to GET HERE);
    if( isset( $_SESSION['id'] ) ) {
        $logged_in = "user={$_SESSION['id']}";
    }

  // CHECKS IF SESSION_ROLE HAS BEEN SET (SHOULD BE SET and SHOULD BE ADMIN to GET HERE);
  // SHOULD BUILD AN IF STATMENT ON FRONT END SO ADMIN ONLY SHOWS IF LOGGED AND ROLE IS ADMIN 
    if( !isset( $_SESSION['role'] ) ) {
        header("Location: ../index.php");
    } else if ( isset( $_SESSION['role'] ) && $_SESSION['role'] !== 'admin' ) {
        header("Location: ../index.php?{$logged_in}");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Blogging Website, with a Content Management System.">
    <meta name="author" content="Wynforth">

    <title><?php echo APP_TITLE_ADMIN; ?></title>

<!--STYLESHEETS
========================================================================================   -->
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- ADMIN BOOTSTRAP CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- ADMIN CUSTOM CSS -->
    <link href="css/main-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<!--SCRIPTS
========================================================================================   -->
    <!-- GOOGLE CHARTS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
</head>
<body>
     <div id="wrapper">