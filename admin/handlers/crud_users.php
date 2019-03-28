<?php 
    $images_dir = "../images";

    // 'CREATE USER'
    if( isset( $_POST[ 'create_user' ] ) ) { 
        $username          = $_POST[ 'username' ];
        $user_password     = $_POST[ 'user_password' ];
        $user_fname        = $_POST[ 'user_fname' ];
        $user_lname        = $_POST[ 'user_lname' ];
        $user_image        = $_FILES[ 'user_image' ][ 'name' ];
        $user_image_temp   = $_FILES[ 'user_image' ][ 'tmp_name' ];
        $user_image_error  = $_FILES[ 'user_image' ][ 'error' ];
        $user_email        = $_POST[ 'user_email' ];
        $user_role         = $_POST[ 'user_role' ];
        $user_about_me     = $_POST[ 'about_me' ];
        $user_my_education = $_POST[ 'my_education' ];
        $user_my_work      = $_POST[ 'my_work' ];

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

        $user_id = createUser( $username, $user_password, $user_fname, $user_lname, $user_email, $user_image, $user_role );

        createProfile( $user_id, $user_about_me, $user_my_education, $user_my_work );
    }

    // (READ) 'GET USER' 
    if( isset( $_GET[ 'user_id' ] ) ) {
        $user_id = $_GET[ 'user_id' ]; 

        $post = getUser( $user_id );
    }
    
    // 'UPDATE USER' 
    if( isset( $_POST[ 'update_user' ] ) ){
        $user_id          = $_POST[ 'user_id' ];
        $username         = $_POST[ 'username' ];
        $user_password    = $_POST[ 'user_password' ];
        $user_fname       = $_POST[ 'user_fname' ];
        $user_lname       = $_POST[ 'user_lname' ];
        $user_image       = $_FILES[ 'user_image' ][ 'name' ];
        $user_image_temp  = $_FILES[ 'user_image' ][ 'tmp_name' ];
        $user_image_error = $_FILES[ 'user_image' ][ 'error' ];
        $user_email       = $_POST[ 'user_email' ];
        $user_role        = $_POST[ 'user_role' ];

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

        updateUser( $user_id, $username, $user_password, $user_fname, $user_lname, $user_email, $user_image, $user_role );
    }

    // 'DELETE USER' 
    if( isset( $_GET[ 'delete' ] ) ) {
        $delete_id = $_GET[ 'delete' ];

        deleteUser( $delete_id ); 
    }
?>