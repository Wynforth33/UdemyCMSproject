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
                    $posts = getPosts( HOME_POST_ORDERBY, HOME_POST_ORDER, HOME_POST_LIMIT );

                    if ( isset( $_GET['page'] ) ) {
                        $page = $_GET['page'];
                        $posts = getPostsByPage( $page );
                    } 
                ?>

                <h1 class="page-header"><?php echo HOME_HEAD ?> <small><?php echo HOME_DESC ?></small></h1>
                
                <?php displayPosts( $posts ) ?>
                    
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>
        
        <?php 
            $post_count = getPostsCount();
            $page = 1;

            include "includes/widgets/pager.php"; 
        ?>
     
<?php include "includes/footer.php" ?>