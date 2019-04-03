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

    <?php include "includes/table_comments.php" ?>       
                    
<!--=====================================================================
END CONTENT -->

<?php include "includes/admin_footer.php" ?>


