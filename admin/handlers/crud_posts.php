<?php 
// 'CREATE POST'
    if( isset( $_POST[ 'create_post' ] ) ) { 
        $post_title         = escape( $_POST[ 'post_title' ] );
        $post_category_id   = escape( $_POST[ 'post_category_id' ] );
        $post_author        = escape( $_POST[ 'post_author' ] );
        $post_image         = escape( $_FILES[ 'post_image' ][ 'name' ] );
        $post_image_temp    = escape( $_FILES[ 'post_image' ][ 'tmp_name' ] );
        $post_image_desc    = escape( $_POST[ 'post_image_desc' ] );
        $post_tags          = escape( $_POST[ 'post_tags' ] );
        $post_content       = escape( $_POST[ 'post_content' ] );

        // FUNCTION MOVES IMAGE FROM TEMPORARY LOCATION INTO GIVEN FOLDER WITH GIVEN NAME
        move_uploaded_file( $post_image_temp, "../images/$post_image" ); 

        $post_id = createPost( $post_category_id, $post_title, $post_author, $post_image, $post_image_desc, $post_tags, $post_content );
    }

// (READ) 'GET POST' 
    if( isset( $_GET[ 'post_id' ] ) ) {
        $post_id = escape( $_GET[ 'post_id' ] ); 

        $post = getPost( $post_id );
    }
    
// 'UPDATE POST' 
    if( isset( $_POST[ 'update_post' ] ) ){
        $post_id            = escape( $_POST[ 'post_id' ] );
        $post_title         = escape( $_POST[ 'post_title' ] );
        $post_category_id   = escape( $_POST[ 'post_category' ] );
        $post_author        = escape( $_POST[ 'post_author' ] );
        $post_status        = escape( $_POST[ 'post_status' ] );
        $post_image         = escape( $_FILES[ 'post_image' ][ 'name' ] );
        $post_image_temp    = escape( $_FILES[ 'post_image' ][ 'tmp_name' ] );
        $post_image_desc    = escape( $_POST[ 'post_image_desc' ] );
        $post_tags          = escape( $_POST[ 'post_tags' ] );
        $post_content       = escape( $_POST[ 'post_content' ] );

        // IF TEMP IMAGE EXISTS, MOVES IMAGE FROM TEMPORARY LOCATION INTO GIVEN FOLDER WITH GIVEN NAME
        if( isset( $post_image_temp ) ) {
            move_uploaded_file( $post_image_temp, "../images/$post_image" ); 
        }

        updatePost( $post_category_id, $post_title, $post_status, $post_author, $post_image, $post_image_desc, $post_tags, $post_content, $post_id );
    }

//  BULK UPDATE/DELETE POSTS
    if( isset( $_POST['checkBoxArray'] ) && !empty($_POST['bulk_options']) ) {
       $check_box_array = escape( $_POST['checkBoxArray'] ); 
       $bulk_options = escape( $_POST['bulk_options'] );

       foreach( $check_box_array as $post_id){
            if( isset( $_SESSION['user_role']) && $_SESSION['user_role'] === 'admin' ) {
                if ( $bulk_options === 'delete' ){
                    deletePost($post_id);
                } elseif ( $bulk_options === 'clone') {
                   $post = getPost($post_id);
                   $post_cat_id     = escape( $post['post_category_id'] );
                   $post_title      = escape( $post['post_title'] );
                   $post_author     = escape( $post['post_author'] );
                   $post_image      = escape( $post['post_image'] );
                   $post_image_desc = escape( $post['post_image_desc'] );
                   $post_tags       = escape( $post['post_tags'] );
                   $post_content    = escape( $post['post_content'] );

                   $post_id = createPost( $post_cat_id, $post_title, $post_author, $post_image, $post_image_desc, $post_tags, $post_content );

                } else {
                    updatePostStatus($post_id, $bulk_options);
                }  
            }
       }

        // REFRESHES THE PAGE
        header("location: admin_posts.php?{$logged_in}");
    }

// 'DELETE POST' 
    if( isset( $_GET[ 'delete' ] ) ) {
        if( isset( $_SESSION['user_role']) && $_SESSION['user_role'] === 'admin' ) {
            $delete_id = escape( $_GET[ 'delete' ] );

            deletePost( $delete_id ); 
        }
    }
?>