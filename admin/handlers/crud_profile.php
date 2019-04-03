<?php 
    $images_dir = "../images";

// (READ) 'GET USER' 
    if( isset( $_SESSION[ 'id' ] ) ){
        $user_id = escape( $_SESSION[ 'id' ] );

        // GET USER DATA
        $user = getUser($user_id);

        // GET USER PROFILE DATA
        $user_profile = getProfile($user_id);
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

        
        updateProfile( $user_id, $username, $user_password, $user_fname, $user_lname, $user_email, $user_image, $user_role );
    }
?>