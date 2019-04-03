<?php define('TITLE', 'Home | PHP CMS Project') ?>

<!-- WEB PAGE -->
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navbar.php" ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if ( isset( $_GET['page'] ) ) {
                        $page = escape($_GET['page']);
                    } 

                    $posts = getPostsByPage( $page, null, null );
                ?>

                <h1 class="page-header"><?php echo HOME_HEAD ?> <small><?php echo HOME_DESC ?></small></h1>
                
                <?php displayPosts( $posts ) ?>
                    
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>
        
        <?php 
            $post_count = getPostsCount(null);
            
            include "includes/widgets/pager.php"; 
        ?>
     
<?php include "includes/footer.php" ?>