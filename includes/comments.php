<?php 
// CREATE COMMENT HANDLER
if( isset( $_POST[ 'create_comment' ] ) ) {
    $comment_author  = $_POST[ 'comment_author' ];
    $comment_email   = $_POST[ 'comment_email' ];
    $comment_content = $_POST[ 'comment_content' ];
    
    createComment($post_id, $comment_author, $comment_email, $comment_content);
}
?>

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
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

$comments = getApprovedCommentsByPost( $post_id, 'comment_id', 'DESC', null ); 

displayComments( $comments );


?>






