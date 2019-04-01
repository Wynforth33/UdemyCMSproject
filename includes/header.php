<?php
    include "constants.php"; 
    include "functions.php";

  // In Charge of Buffering Requests in the headers of scripts so that when done 
  // with scripts it will send everything at one time rather than one at a time  
    ob_start();
    session_start();
    $time = time();
    $session = session_id(); 
    $logged_in = null;
    $user_id = null;
    $user_name = '';
    $user_role = '';

  // CHECKS IF SESSION_ID HAS BEEN SET (SHOULD BE SET to GET HERE);
    if( isset( $_SESSION[ 'id' ] ) ) {
        $logged_in = "user={$_SESSION[ 'id' ]}";
        $user_id = $_SESSION[ 'id' ];
        $user_name = $_SESSION[ 'username' ];
        $user_role = $_SESSION[ 'role' ];
    }

    $exists = checkBySession( $session );

    if(!$exists){
        loginOnlineSession( $session, $time, $user_id, $user_role );
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