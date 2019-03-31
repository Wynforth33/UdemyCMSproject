<?php 
    include "includes/admin_header.php";
    $users = getOnlineUsers();
    $source = null;

 // HANDLERS
    include "handlers/crud_users.php";
?>

<!-- Navigation -->
<?php include "includes/admin_navbar.php" ?>                                                               

<!--  CONTENT
----------------------------------------------------------->
    <?php 
      // 'ROUTING' [HANDLER]    
        if( isset( $_GET[ 'source' ] ) ) {
            $source = $_GET[ 'source' ];
        }
        
      // ROUTES 
        switch( $source ) {
            case 'add_user';   
            include "includes/add_user.php";
            break;

            case 'edit_user';
            include "includes/edit_user.php";
            break;

            case 'online_users';
            include "includes/online_users_table.php";
            break;

            default: 
            include "includes/users_table.php";
            break;
        }   
    ?>                       
<!----------------------------------------------------------  
--  END CONTENT -->                                    

<?php include "includes/admin_footer.php" ?>

