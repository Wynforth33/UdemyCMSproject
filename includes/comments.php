
<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <?php 
    // CREATE COMMENT HANDLER
        if( isset( $_POST[ 'create_comment' ] ) ) {
            $comment_author  = escape( $_POST[ 'comment_author' ] );
            $comment_email   = escape( $_POST[ 'comment_email' ] );
            $comment_content = escape( $_POST[ 'comment_content' ] );
            $current_comment_id = 0;

            if ( !empty($comment_author) && !empty($comment_email) && !empty($comment_content) ) {
                createComment($post_id, $comment_author, $comment_email, $comment_content );
            } else {
                // echo "<script>alert('Fields Cannot Be Empty!')</script>";
                echo "<p class='bg-danger'>Fields Cannot Be Empty</p>";
            }
        } 
    ?>
    <form role="form" action="" method="Post">
        <div class="form-group">
           <label for="comment_author">Author</label>
            <input type="text" class="form-control" name="comment_author">
        </div> 
        
        <div class="form-group">
            <label for="comment_email">Email</label>
            <input type="email" class="form-control" name="comment_email">
        </div>
       
        <div class="form-group">
            <label for="comment_content">Your Comment</label>
            <textarea class="form-control" rows="3" name="comment_content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->
   
<?php  

$comments = getApprovedCommentsByPost( escape( $post_id ), 'comment_id', 'ASC', null ); 

displayComments( $comments );


?>






