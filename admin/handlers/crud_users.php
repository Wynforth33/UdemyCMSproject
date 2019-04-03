<?php 
    $images_dir = "../images";
    $isMessage = false;
    $message = null;

// 'CREATE USER'
    if( isset( $_POST[ 'create_user' ] ) ) { 
        // GATHER ALL FORM VALUES, CLEAN THEM FOR DATABASE INSERTION, and SAVE THEM TO VARIABLES
        $username          = escape( $_POST[ 'username' ] );
        $user_password     = escape( $_POST[ 'user_password' ] );
        $user_fname        = escape( $_POST[ 'user_fname' ] );
        $user_lname        = escape( $_POST[ 'user_lname' ] );
        $user_image        = escape( $_FILES[ 'user_image' ][ 'name' ] );
        $user_image_temp   = escape( $_FILES[ 'user_image' ][ 'tmp_name' ] );
        $user_image_error  = escape( $_FILES[ 'user_image' ][ 'error' ] );
        $user_email        = escape( $_POST[ 'user_email' ] );
        $user_role         = escape( $_POST[ 'user_role' ] );
        $user_about_me     = escape( $_POST[ 'about_me' ] );
        $user_my_education = escape( $_POST[ 'my_education' ] );
        $user_my_work      = escape( $_POST[ 'my_work' ] );

        // CHECK FOR ERROR CODES ON IMAGE UPLOAD
        if ( $user_image_error && $user_image_error === 1 ) {
            echo "Image file size too Big!";
            die;
        } elseif ( $user_image_error && !$user_image_error === 1 ) {
            echo "Error Code Thrown: Value = {$user_image_error}; check http://php.net/manual/en/features.file-upload.errors.php ";
            die;
        }

        // CHECK IF USERNAME ALREADY EXISTS IF IT DOESN'T CONTINUE USER CREATION; ELSE THROW ERROR
        if(!searchForUserByUsername( $username )) {

            // ENCYRPT PASSWORD FOR STORAGE
            $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 12) );

            // CHECK FOR ERROR CODES ON IMAGE UPLOAD
            if ( $user_image_error && $user_image_error === 1 ) {
                echo "Image file size too Big!";
                die;
            } elseif ( $user_image_error && !$user_image_error === 1 ) {
                echo "Error Code Thrown: Value = {$user_image_error}; check http://php.net/manual/en/features.file-upload.errors.php ";
                die;
            }
        
            // FUNCTION MOVES IMAGE FROM TEMPORARY LOCATION INTO GIVEN FOLDER WITH GIVEN NAME
            move_uploaded_file( $user_image_temp, "$images_dir/$user_image" ); 

            // CREATE USER CAPTURE ID
            $created_user_id = createUser( $username, $user_password, $user_fname, $user_lname, $user_email, $user_image, $user_role );

            // IF USER CREATION FAILS WILL THROW ERROR
            if ( !$created_user_id ) {
                $isMessage = true;
                $message   = "Database Creation Process Failed!";
            }

            // IF USER CREATION IS SUCCESS USE CREATED USER ID TO STORE PROFILE DATA IN PROFILES
            createProfile( $created_user_id, $user_about_me, $user_my_education, $user_my_work );

        } else {

            $isMessage = true;
            $message   = "Username Already Exists!";
        }
    }

// (READ) 'GET USER' 
    if( isset( $_GET[ 'user_id' ] ) ) {
        $user_id = escape( $_GET[ 'user_id' ] ); 

        $post = getUser( $user_id );
    }
    
// 'UPDATE USER' 
    if( isset( $_POST[ 'update_user' ] ) ){
        $user_id          = escape( $_POST[ 'user_id' ] );
        $username         = escape( $_POST[ 'username' ] );
        $user_password    = escape( $_POST[ 'user_password' ] );
        $user_fname       = escape( $_POST[ 'user_fname' ] );
        $user_lname       = escape( $_POST[ 'user_lname' ] );
        $user_image       = escape( $_FILES[ 'user_image' ][ 'name' ] );
        $user_image_temp  = escape( $_FILES[ 'user_image' ][ 'tmp_name' ] );
        $user_image_error = escape( $_FILES[ 'user_image' ][ 'error' ] );
        $user_email       = escape( $_POST[ 'user_email' ] );
        $user_role        = escape( $_POST[ 'user_role' ] );

        // ENCYRPT PASSWORD FOR STORAGE
        $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 12) );

        // CHECK FOR ERROR CODES ON IMAGE UPLOAD
        if ( $user_image_error && $user_image_error === 1 ) {
            echo "Image file size too Big!";
            die;
        } elseif ( $user_image_error && !$user_image_error === 1 ) {
            echo "Error Code Thrown: Value = {$user_image_error}; check http://php.net/manual/en/features.file-upload.errors.php ";
            die;
        }
        
        // IF TEMP IMAGE EXISTS, MOVES IMAGE FROM TEMPORARY LOCATION INTO GIVEN FOLDER WITH GIVEN NAME
        if( isset( $user_image_temp ) ) { 
          move_uploaded_file( $user_image_temp, "$images_dir/$user_image" ); 
        }

        // UPDATE USER; IF PROCESS FAILS WILL THROW ERROR
        if( !updateUser( $user_id, $username, $user_password, $user_fname, $user_lname, $user_email, $user_image, $user_role ) ) {
            $isMessage = true;
            $message   = "Database Update Process Failed!";
        }
    }

// 'DELETE USER' 
    if( isset( $_GET[ 'delete' ] ) ) {
        if( isset( $_SESSION['user_role'] ) && $_SESSION['user_role'] === 'admin' ) {
            $delete_id = escape( $_GET[ 'delete' ] );

            deleteUser( $delete_id ); 
        }
    }
?>