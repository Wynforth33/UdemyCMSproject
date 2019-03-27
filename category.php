<?php define('TITLE', 'Category | PHP CMS Project') ?>

<!-- WEB PAGE  -->
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navbar.php" ?>

    <!-- Page Content -->
    <div class="container">
        <?php 
        if( isset( $_GET['category'] ) ) {
            $cat_id = $_GET['category'];
            
            $category = getCategory( $cat_id );
            
            $posts = getPostsByCategory( $cat_id, CAT_POST_ORDERBY, CAT_POST_ORDER, CAT_POST_LIMIT );  
        }
        ?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">Category: <?php echo $category ?></h1>
                
            <?php displayPosts( $posts ) ?>
                    
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>

<?php include "includes/footer.php" ?>