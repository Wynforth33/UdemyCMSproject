<?php 
    include "includes/admin_header.php";
    $posts = getPosts( 'post_date', 'DESC', null ); 
    $source = "";
    $subtitle = "";

 // HANDLERS
    include "handlers/crud_posts.php";
    include "handlers/posts_sorting.php";
?>

<!-- Navigation -->
<?php include "includes/admin_navbar.php" ?>

<!-- CONTENT 
======================================================================-->
    <?php
      // 'ROUTING' [HANDLER]    
        if( isset( $_GET[ 'source' ] ) ) {
            $source = $_GET[ 'source' ];
        }
        
      // ROUTES
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
<!--=====================================================================
 END CONTENT -->

<?php include "includes/admin_footer.php" ?>

