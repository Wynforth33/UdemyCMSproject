<?php 
    // 'CREATE CATEGORY'    
    if( isset( $_POST[ 'submit' ] ) ) { 
        $cat_title = $_POST[ 'cat_title' ];

        createCategory( $cat_title ); 
    } 

    // 'UPDATE CATEGORY' 
    if( isset( $_POST[ 'update' ] ) ) {
        $cat_id = $_GET['edit'];
        $updated_title = $_POST['cat_title'];

        updateCategory( $cat_id, $updated_title );
    }

    // 'DELETE CATEGORY'
    if( isset( $_GET[ 'delete' ] ) ) { 
        $delete_id = $_GET['delete'];

        deleteCategory( $delete_id ); 
    }   
?>