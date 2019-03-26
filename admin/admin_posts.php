<?php 
    include "includes/admin_header.php";
    $posts = getPosts( 'post_date', 'DESC', null ); 
    $source = "";
    $subtitle = "";

 // HANDLERS
    include "handlers/crud_posts.php";
    include "handlers/posts_sorting.php";
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
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                    <?php
                        if( isset( $_GET[ 'source' ] ) ) {
                            $source = $_GET[ 'source' ];
                        } 
        
                        switch( $source ) {
                            case 'add_post';   
                            include "includes/add_post.php";
                            break;

                            case 'edit_post';
                            include "includes/edit_post.php";
                            break;

                            default: 
                            include "includes/posts_table.php";
                            break;
                        }   
                    ?>                      

                </div><!-- .col-lg-12 -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- #page-wrapper -->
    
<?php include "includes/admin_footer.php" ?>

<!--=====================================================================
 END CONTENT -->