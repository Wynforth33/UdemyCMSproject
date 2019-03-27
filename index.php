<?php define('TITLE', 'Home | PHP CMS Project') ?>

<!-- WEB PAGE -->
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navbar.php" ?>

    <!-- Page Content -->
    <div class="container">
       
        <?php $posts = getPosts( HOME_POST_ORDERBY, HOME_POST_ORDER, HOME_POST_LIMIT ) ?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header"><?php echo HOME_HEAD ?> <small><?php echo HOME_DESC ?></small></h1>
                
                <?php displayPosts( $posts ) ?>
                    
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>

<?php include "includes/footer.php" ?>