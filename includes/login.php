<?php 
$user = null; 
session_start();

$_SESSION[ 'username' ] = null;
$_SESSION[ 'fname' ]    = null;
$_SESSION[ 'lname' ]    = null;
$_SESSION[ 'role' ]     = null;

// INCLUDES
include "functions.php";
include "constants.php";

if( isset($_POST[ 'login' ]) ) {
    $username = $_POST[ 'username' ];
    $password = $_POST[ 'password' ];

    // CLEAN UP VALUES FOR SAFE USE WITH DATABASE
    $safe_user_values = cleanLoginValues($username, $password);

    $crypted_password = encryptPassword($safe_user_values['password'], HASH, SALT1);

    // CHECKS IF USER EXISTS; IF EXISTS WILL RETURN $USER DATA AS AN ARRAY, IF DOESN'T EXIST WILL RETURN 0 (FALSE)
    $user_data = getUserDataArray( $safe_user_values['username'] );

    // IF USER DOES NOT EXIST, REDIRECT BACK TO INDEX (Failure Trigger - USERNAME DOES NOT EXIST)
    if (!$user_data) {
        header("Location: ../index.php?fail=1");

    // IF USER PASSWORD IS INCORRECT, REDIRECT BACK TO INDEX (Failure Trigger - PASSWORD INCORRECT)   
    } elseif ($user_data['user_password'] !== $crypted_password ) {
        header("Location: ../index.php?fail=2");

    // ELSE SESSIONIZE USER DATA AND REDIRECT BASED ON USER_ROLE    
    } else {
        sessionizeUserData($user_data);

        switch($user_data['user_role']){
            case 'admin';
            header("Location: ../admin?user={$user_data['user_id']}");
            break;

            case 'subscriber'; 
            header("Location: ../index.php?user={$user_data['user_id']}");
            break;  
        }
    }
}   
?>