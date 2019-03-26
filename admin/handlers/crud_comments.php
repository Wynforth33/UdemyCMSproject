<?php
  // (UPDATE) 'APPROVE COMMENT'
  if( isset( $_GET[ 'approve' ] ) ) {
      $approve_id = $_GET[ 'approve' ];
    
      approveComment( $approve_id );
  }

  // (UPDATE) 'DENY COMMENT' 
  if( isset( $_GET[ 'deny' ] ) ) {
      $deny_id = $_GET[ 'deny' ];
    
      denyComment( $deny_id );
  }

  // 'DELETE COMMENT'
  if( isset( $_GET[ 'delete' ] ) ) {
      $delete_id = $_GET[ 'delete' ];
      $post_id   = $_GET[ 'post_id' ];
    
      deleteComment( $post_id, $delete_id ); 
  }
?>