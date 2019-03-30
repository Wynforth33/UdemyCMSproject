<?php 
    // 'CREATE POST'
    if( isset( $_POST[ 'create_post' ] ) ) { 
        $post_title         = $_POST[ 'post_title' ];
        $post_category_id   = $_POST[ 'post_category_id' ];
        $post_author        = $_POST[ 'post_author' ];
        $post_image         = $_FILES[ 'post_image' ][ 'name' ];
        $post_image_temp    = $_FILES[ 'post_image' ][ 'tmp_name' ];
        $post_image_desc    = $_POST[ 'post_image_desc' ];
        $post_tags          = $_POST[ 'post_tags' ];
        $post_content       = $_POST[ 'post_content' ];

        // FUNCTION MOVES IMAGE FROM TEMPORARY LOCATION INTO GIVEN FOLDER WITH GIVEN NAME
        move_uploaded_file( $post_image_temp, "../images/$post_image" ); 

        $post_id = createPost( $post_category_id, $post_title, $post_author, $post_image, $post_image_desc, $post_tags, $post_content );
    }

    // (READ) 'GET POST' 
    if( isset( $_GET[ 'post_id' ] ) ) {
        $post_id = $_GET[ 'post_id' ]; 

        $post = getPost( $post_id );
    }
    
    // 'UPDATE POST' 
    if( isset( $_POST[ 'update_post' ] ) ){
        $post_id            = $_POST[ 'post_id' ];
        $post_title         = $_POST[ 'post_title' ];
        $post_category_id   = $_POST[ 'post_category' ];
        $post_author        = $_POST[ 'post_author' ];
        $post_status        = $_POST[ 'post_status' ];
        $post_image         = $_FILES[ 'post_image' ][ 'name' ];
        $post_image_temp    = $_FILES[ 'post_image' ][ 'tmp_name' ];
        $post_image_desc    = $_POST[ 'post_image_desc' ];
        $post_tags          = $_POST[ 'post_tags' ];
        $post_content       = $_POST[ 'post_content' ];

        // IF TEMP IMAGE EXISTS, MOVES IMAGE FROM TEMPORARY LOCATION INTO GIVEN FOLDER WITH GIVEN NAME
        if( isset( $post_image_temp ) ) {
            move_uploaded_file( $post_image_temp, "../images/$post_image" ); 
        }

        updatePost( $post_category_id, $post_title, $post_status, $post_author, $post_image, $post_image_desc, $post_tags, $post_content, $post_id );
    }

    // BULK UPDATE/DELETE POSTS
    if( isset( $_POST['checkBoxArray'] ) && !empty($_POST['bulk_options']) ) {
       $check_box_array = $_POST['checkBoxArray']; 
       $bulk_options = $_POST['bulk_options'];

       foreach( $check_box_array as $post_id){
            if ( $bulk_options === 'delete' ){
                deletePost($post_id);
            } elseif ( $bulk_options === 'clone') {
               $post = getPost($post_id);
               $post_cat_id     = $post['post_category_id'];
               $post_title      = $post['post_title'];
               $post_author     = $post['post_author'];
               $post_image      = $post['post_image'];
               $post_image_desc = $post['post_image_desc'];
               $post_tags       = $post['post_tags'];
               $post_content    = $post['post_content'];

               $post_id = createPost( $post_cat_id, $post_title, $post_author, $post_image, $post_image_desc, $post_tags, $post_content );

            } else {
                updatePostStatus($post_id, $bulk_options);
            }  

       }

        // REFRESHES THE PAGE
        header("location: admin_posts.php?{$logged_in}");
    }

    // 'DELETE POST' 
    if( isset( $_GET[ 'delete' ] ) ) {
        $delete_id = $_GET[ 'delete' ];

        deletePost( $delete_id ); 
    }
?>