<?php 
    include "includes/admin_header.php";
    $categories = getCategories(null);

 // HANDLERS
    include "handlers/crud_categories.php";
?>

<!-- CONTENT 
======================================================================-->
                                     
<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navbar.php" ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <h1 class="page-header">
                    Welcome to Administration
                    <small><?php echo $_SESSION['username'] ?></small>
                </h1>

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
                                $cat_id = $_GET['edit'];
                                $category = getCategory( $cat_id ); 

                                include "includes/update_categories.php";
                            } 
                        ?>

                   </div><!-- .col-sm-6 -->                      

                   <!-- CATEGORY TABLE -->
                   <div class="col-md-6">

                       <table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>Id</th>
                                   <th>Category Title</th>
                               </tr>
                           </thead>
                           <tbody>

                               <?php displayCategoryTable( $categories ) ?>

                           </tbody>
                       </table>

                   </div><!-- .col-md-6 -->     
                </div><!-- .row -->
                
            </div><!-- .col-lg-12 -->
        </div><!-- .row -->
        
    </div><!-- .container-fluid -->
</div><!-- #page-wrapper -->
    
<?php include "includes/admin_footer.php" ?>

<!--=====================================================================
 END CONTENT -->