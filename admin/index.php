<?php include "includes/admin_header.php" ?>

<!-- Navigation -->
<?php include "includes/admin_navbar.php" ?>
 
<!--  CONTENT
----------------------------------------------------------->
    <!-- DASHBOARD WIDGETS -->
    <div class="row">

        <?php include "includes/widgets/posts.php" ?>

        <?php include "includes/widgets/comments.php" ?>

        <?php include "includes/widgets/users.php" ?>

        <?php include "includes/widgets/categories.php" ?>

    </div><!-- .row -->

    <!-- GOOGLE CHARTS -->
    <?php include "includes/widgets/chart.php" ?>
<!----------------------------------------------------------  
--  END CONTENT -->

<?php include "includes/admin_footer.php" ?>