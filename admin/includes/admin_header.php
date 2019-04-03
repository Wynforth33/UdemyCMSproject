<?php 
	include "../includes/ChromePHP.php";
    include "../includes/constants.php"; 
    include "../includes/functions.php";
   

  // In Charge of Buffering Requests in the headers of scripts so that when done 
  // with scripts it will send everything at one time rather than one at a time  
    ob_start();
    session_start();
    $time = time();
    $session = session_id(); 
    $logged_in = null;
    $user_id = null;
    $username = '';
    $user_role = '';

 // CHECKS IF SESSION_ID HAS BEEN SET (SHOULD BE SET to GET HERE);
    if( isset( $_SESSION[ 'id' ] ) ) {
        $user_id   = escape( $_SESSION[ 'id' ] );
        $username  = escape( $_SESSION[ 'username' ] );
        $user_role = escape( $_SESSION[ 'role' ] );
        $logged_in = "user={$user_id}";
    }
    
  // CHECKS TO SEE IF CURRENT SESSION HAS ALREADY BEEN SAVED; IF HASN'T LOG SESSION TO DB, ELSE UPDATE SESSION IN DB
    if(!checkBySession( $session )){
        logOnlineSession( $session, $time, $user_id, $user_role );
    } else {
        updateOnlineUser( $session, $time, $user_id, $user_role );
    }

  // CHECKS IF SESSION_ROLE HAS BEEN SET (SHOULD BE SET and SHOULD BE ADMIN to GET HERE);
  // SHOULD BUILD AN IF STATMENT ON FRONT END SO ADMIN ONLY SHOWS IF LOGGED AND ROLE IS ADMIN 
    if( !$user_role ) {
        header("Location: ../index.php");
    } else if ( $user_role && $user_role !== 'admin' ) {
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
    <!-- DATATABLES CSS -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

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
    <div id='load-screen'>
        <div id='loading'></div>
    </div>

    <div id="wrapper">