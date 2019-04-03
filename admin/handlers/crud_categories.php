<?php 
// 'CREATE CATEGORY' 
    if( isset( $_POST[ 'submit' ] ) ) { 
        $cat_title = escape( $_POST[ 'cat_title' ] );

        createCategory( $cat_title ); 
    }

// 'UPDATE CATEGORY'
    if( isset( $_POST[ 'update' ] ) ) {
        $cat_id = escape( $_GET['edit'] );
        $updated_title = escape( $_POST['cat_title'] );

        updateCategory( $cat_id, $updated_title );
    }

// 'DELETE CATEGORY'
    if( isset( $_GET[ 'delete' ] ) ) { 
        if( isset( $_SESSION['user_role'] ) && $_SESSION['user_role'] === 'admin' ) {
            $delete_id = escape( $_GET['delete'] );

            deleteCategory( $delete_id ); 
        }
    }   
?>