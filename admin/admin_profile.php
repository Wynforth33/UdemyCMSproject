<?php 
    include "includes/admin_header.php";

    $user_id = null;
    $user = null;
    $user_profile = null;
    $source = null;

 // HANDLERS
    include "handlers/crud_profile.php";
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
            case 'edit_profile';
            include "includes/edit_profile.php";
            break;

            default: 
            include "includes/profile.php";
            break;
        }   
    ?>
<!--=====================================================================
 END CONTENT -->
    
<?php include "includes/admin_footer.php" ?>

