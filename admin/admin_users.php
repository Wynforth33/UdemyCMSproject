<?php 
    include "includes/admin_header.php";
    $users = getUsers();
    $source = null;

 // HANDLERS
    include "handlers/crud_users.php";

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
                        
                        <?php 
                        // 'ROUTING' [HANDLERS]    
                            if( isset( $_GET[ 'source' ] ) ) {
                                $source = $_GET[ 'source' ];
                            }

                            switch( $source ) {
                                case 'add_user';   
                                include "includes/add_user.php";
                                break;

                                case 'edit_user';
                                include "includes/edit_user.php";
                                break;

                                default: 
                                include "includes/users_table.php";
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
