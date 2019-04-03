<?php define('TITLE', 'Category | PHP CMS Project') ?>

<!-- WEB PAGE  -->
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navbar.php" ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    $cat_id = null;
                    $category = null;

                    if( isset( $_GET['category'] ) ) {
                        $cat_id = escape($_GET['category']);
                        $category = getCategory( $cat_id ); 
                    }

                    if ( isset( $_GET['page'] ) ) {
                        $page = escape( $_GET['page'] );
                    } 

                    $posts = getPostsByPage( $page, null, $cat_id )
                ?>

                <h1 class="page-header">Category: <?php echo $category ?></h1>
                
            <?php displayPosts( $posts ) ?>
                    
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>

        <?php 
            $post_count = getPostCountByCategory($cat_id);
            include "includes/widgets/pager.php"; 
        ?>

<?php include "includes/footer.php" ?>