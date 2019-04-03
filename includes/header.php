<?php
    include "ChromePHP.php";
    include "constants.php"; 
    include "functions.php";
    
  // In Charge of Buffering Requests in the headers of scripts so that when done 
  // with scripts it will send everything at one time rather than one at a time  
    ob_start();
    session_start();

  // NECESSARY GLOBAL VARIABLES 
    $time      = time();
    $session   = session_id(); 
    $logged_in = null; 
    $user_id   = null; 
    $user_name = null; 
    $user_role = null;
    $posts     = null; 
    $page      = 1;

  // CHECKS IF USER ID HAS BEEN SESSIONIZED (SHOULD BE SET to GET HERE);
    if( isset( $_GET[ 'user' ] ) ) {
        $user_id   = escape( $_GET[ 'user' ] );
        $logged_in = "user={$user_id}";
        $user_data = getUser( $user_id );
        $user_name = $user_data[ 'username' ];
        $user_role = $user_data[ 'user_role' ];
    }

  // CHECKS TO SEE IF CURRENT SESSION HAS ALREADY BEEN SAVED; IF HASN'T LOG SESSION TO DB, ELSE UPDATE SESSION IN DB
    if(!checkBySession( $session )){
        logOnlineSession( $session, $time, $user_id, $user_role );
    } else {
        updateOnlineUser( $session, $time, $user_id, $user_role );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo TITLE ?></title>

<!--LINKS
========================================================================================   -->
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

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
    <div id='load-screen'>
        <div id='loading'></div>
    </div>