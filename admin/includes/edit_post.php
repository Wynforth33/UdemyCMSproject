<?php 
    $post = getPost( $post_id );
    $categories = getCategories( null );
?>

<!-- CONTENT 
======================================================================-->
<h2>Edit Post</h2>
  
<form action="admin_posts.php" method="Post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="text" class="form-control" name="post_title" value="<?php echo $post[ 'post_title' ]; ?>">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_category">Category</label>
        <select name="post_category" id="post_category">
            
            <?php displayCategoryOptions( $categories ); ?>
            
        </select>
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="post_author">Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post[ 'post_status' ]; ?>">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_author">Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post[ 'post_author' ]; ?>">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post[ 'post_image' ]; ?>">
        <input type="file" class="form-control" name="post_image">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_image_desc">Image Description</label>
        <input type="text" class="form-control" name="post_image_desc" value="<?php echo $post[ 'post_image_desc' ]; ?>">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post[ 'post_tags' ]; ?>">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_content">Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows ="10"><?php echo $post[ 'post_content' ]; ?>
        </textarea>
    </div><!-- .form-group -->
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div><!-- .form-group -->
     
</form>

<!--=====================================================================
END CONTENT -->

