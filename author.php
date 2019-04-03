<?php define("TITLE", "Author | PHP CMS Project") ?>
    
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
                    $author = null; 

                    if( isset( $_GET['author'] ) ) {
                        $author = escape( $_GET['author'] );
                    }

                    if ( isset( $_GET['page'] ) ) {
                        $page = escape( $_GET['page'] );
                    } 

                    $posts = getPostsByPage( $page, $author, null );
                ?>

                <h1 class="page-header">Author: <?php echo $author ?></h1>
                
            <?php displayPosts( $posts ) ?>
                    
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>

        <?php 
            $post_count = getPostCountByAuthor($author);
            
            include "includes/widgets/pager.php"; 
        ?>

<?php include "includes/footer.php" ?>