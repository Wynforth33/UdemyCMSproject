<?php
// (UPDATE) 'APPROVE COMMENT'
    if( isset( $_GET[ 'approve' ] ) ) {
        $approve_id = escape( $_GET[ 'approve' ] );
      
        approveComment( $approve_id );
    }

// (UPDATE) 'DENY COMMENT' 
    if( isset( $_GET[ 'deny' ] ) ) {
        $deny_id = escape( $_GET[ 'deny' ] );
      
        denyComment( $deny_id );
    }

// 'DELETE COMMENT'
    if( isset( $_GET[ 'delete' ] ) ) {
        if( isset( $_SESSION['user_role'] ) && $_SESSION['user_role'] === 'admin' ) {
            $delete_id = escape( $_GET[ 'delete' ] );
            $post_id   = escape( $_GET[ 'post_id' ] );
          
            deleteComment( $post_id, $delete_id ); 
        }
    }
?>