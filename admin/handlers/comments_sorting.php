<?php
  // 'BY_AUTHOR'
  if( isset( $_GET[ 'author' ] ) ) {
      $author = $_GET[ 'author' ];
      $subtitle = ": Author - {$author}";
    
      $comments = getCommentsByAuthor( $author, 'comment_date', 'DESC', null );
  }

  // 'BY_POST'
  if( isset( $_GET[ 'post_id' ] ) ) {
      $post_id = $_GET[ 'post_id' ];
      $post = getPost( $post_id );
      $post_title = $post[ 'post_title' ];
      $subtitle = ": Post - {$post_title}";

      $comments = getCommentsByPost( $post_id, 'comment_date', 'DESC', null );  
  }
?>