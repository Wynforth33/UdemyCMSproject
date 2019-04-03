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
    $username = escape( $_POST[ 'username' ] );
    $password = escape( $_POST[ 'password' ] );

    // ENCRYPT PASSWORD
    $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12) ); 

    // CHECKS IF USER EXISTS; IF EXISTS WILL RETURN $USER DATA AS AN ARRAY, IF DOESN'T EXIST WILL RETURN 0 (FALSE)
    $user_data = getUserDataArray( $username );

    // IF USER DOES NOT EXIST, REDIRECT BACK TO INDEX (Failure Trigger - USERNAME DOES NOT EXIST)
    if ( !$user_data ) {
        header("Location: ../index.php?fail=1");

    // IF USER PASSWORD IS INCORRECT, REDIRECT BACK TO INDEX (Failure Trigger - PASSWORD INCORRECT)   
    } elseif ( password_verify( $password, $user_data['password'] ) ) {
        header("Location: ../index.php?fail=2");

    // ELSE SESSIONIZE USER DATA AND REDIRECT BASED ON USER_ROLE    
    } else {
        sessionizeUserData($user_data);

        switch($user_data['user_role']){
            case 'admin';
            header("Location: ../admin/index.php?user={$user_data['user_id']}");
            break;

            case 'subscriber'; 
            header("Location: ../index.php?user={$user_data['user_id']}");
            break;  

            case 'test user';
            header("Location: ../index.php?user={$user_data['user_id']}");
            break; 
        }
    }
}   
?>