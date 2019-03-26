<!-- CONTENT 
======================================================================-->

<form action="" method="Post">
   <label for="cat_title">Edit Category</label>

   <div class="form-group">
       <input 
           value="<?php echo $category; ?>" type="text" 
           name="cat_title" 
           class="form-control">
   </div><!-- .form-group -->
   
   <div class="form-group">
       <input type="submit" name="update" class="btn btn-primary" value="Update Category">
   </div><!-- .form-group -->
</form>

<!--=====================================================================
 END CONTENT -->
 
