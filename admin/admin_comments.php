<?php 
    include "includes/admin_header.php"; 
    $comments = getComments( 'comment_date', 'DESC', null ); 
    $source = "";
    $subtitle = "";

 // HANDLERS
    include "handlers/crud_comments.php";
    include "handlers/comments_sorting.php";
?>     

<!-- Navigation -->
<?php include "includes/admin_navbar.php" ?>                                                          
                                                             
<!-- CONTENT 
======================================================================-->                                                                      
    <?php 
    // 'ROUTING' [HANDLERS]    
        if( isset( $_GET[ 'source' ] ) ) {
            $source = $_GET[ 'source' ];
        }

        switch( $source ) {
            case 'add_comment';   
            include "includes/add_comment.php";
            break;

            case 'edit_comment';
            include "includes/edit_comment.php";
            break;

            default: 
            include "includes/comments_table.php";
            break;
        }   
    ?>                       
<!--=====================================================================
END CONTENT -->

<?php include "includes/admin_footer.php" ?>


