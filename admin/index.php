<?php include "includes/admin_header.php" ?>

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
                        
                        <!-- DASHBOARD WIDGETS -->
                        <div class="row">

                            <?php include "includes/widgets/posts.php" ?>

                            <?php include "includes/widgets/comments.php" ?>

                            <?php include "includes/widgets/users.php" ?>

                            <?php include "includes/widgets/categories.php" ?>
   
                        </div><!-- .row -->

                        <!-- GOOGLE CHARTS -->
                        <?php include "includes/widgets/chart.php" ?>

                    </div><!-- .col-lg-12 -->
                </div><!-- .row -->
          
            </div><!-- .container-fluid -->
        </div><!-- #page-wrapper -->

<?php include "includes/admin_footer.php" ?>