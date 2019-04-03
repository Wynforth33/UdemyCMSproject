<?php $categories = getCategories( null ); ?>

<h2>Create Post</h2>

<?php 
//  POST CREATED NOTIFICATION (This handler required here for placement of notification and link)
    if( isset( $_POST[ 'create_post' ] ) ) { 
        echo "<p class='bg-success'>Post Created: <a href='../post.php?{$logged_in}&post_id={$post_id}'>View Post</a> or <a href='admin_posts.php?{$logged_in}'>View All Posts</a></p>";
    }  
?>
  
<form action="" method="Post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" class="form-control" name="post_title">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_category">Category</label>
        <select name="post_category_id" id="post_category">
            
            <?php displayCategoryOptions( $categories ); ?>
            
        </select>
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_author">Author</label>
        <input type="text" class="form-control" name="post_author">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" class="form-control" name="post_image">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_image_desc">Image Description</label>
        <input type="text" class="form-control" name="post_image_desc">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="post_content">Content</label>
        <textarea class="form-control" id="body" name="post_content" cols="30" rows ="10">
        </textarea>
    </div><!-- .form-group -->
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Create Post">
    </div><!-- .form-group -->
     
</form>

