<?php 
    include "includes/admin_header.php";
    $categories = getCategories(null);

 // HANDLERS
    include "handlers/crud_categories.php";
?>

<!-- Navigation -->
<?php include "includes/admin_navbar.php" ?>

<!-- CONTENT 
======================================================================-->
  <div class="row">
     <div class="col-md-6">

          <!-- ADD CATEGORY FORM -->
          <form action="" method="Post">
              <label for="cat_title">Add Category</label>
              <div class="form-group">
                  <input type="text" name="cat_title" class="form-control">
              </div><!-- .form-group -->

              <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
              </div><!-- .form-group -->
          </form>

          <?php 
            // 'UPDATE CATEGORY FORM' [HANDLER]; Only appears if currently 'Editing' a Category.
              if( isset( $_GET['edit'] ) ) {
                  $cat_id = escape( $_GET['edit'] );
                  $category = getCategory( $cat_id ); 

                  include "includes/edit_categories.php";
              } 
          ?>

     </div><!-- .col-sm-6 -->                      

     <!-- CATEGORY TABLE -->
     <div class="col-md-6">

         <?php include "includes/table_categories.php" ?>

     </div><!-- .col-md-6 -->     
  </div><!-- .row -->               
<!--=====================================================================
 END CONTENT -->

<?php include "includes/admin_footer.php" ?>

