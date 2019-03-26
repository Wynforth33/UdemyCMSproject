<?php $categories = getCategories( null ); ?>

<!-- CONTENT 
======================================================================-->

<h2>Create Post</h2>
  
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
        <textarea class="form-control" name="post_content" id="" cols="30" rows ="10">
        </textarea>
    </div><!-- .form-group -->
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div><!-- .form-group -->
     
</form>

<!--=====================================================================
END CONTENT -->
