<?php define("TITLE", "Author | PHP CMS Project") ?>
    
<!-- WEB PAGE  -->
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navbar.php" ?>

    <!-- Page Content -->
    <div class="container">

        <?php
            $posts = null;
            $page = 1; 

            if( isset( $_GET['author'] ) ) {
                $author = $_GET['author'];
                $posts_total = getPostsByAuthor( $author, AUTHOR_POST_ORDERBY, AUTHOR_POST_ORDER, null ); 
                $posts = getPostsByAuthor( $author, AUTHOR_POST_ORDERBY, AUTHOR_POST_ORDER, AUTHOR_POST_LIMIT );  
            }

            $post_count = mysqli_num_rows($posts_total);

        ?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if ( isset( $_GET['page'] ) ) {
                        $page = $_GET['page'];
                    } 
                ?>

                <h1 class="page-header">Author: <?php echo $author ?></h1>
                
            <?php displayPosts( $posts ) ?>
                    
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>

        <?php include "includes/widgets/pager.php" ?>

<?php include "includes/footer.php" ?>