<?php define("TITLE", "Search | PHP CMS Project") ?>

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
                    if( isset( $_POST[ 'submit' ] ) ) {
                        $search  = $_POST[ 'search' ];
                        $orderBy = $_POST[ 'orderBy' ];
                        $order   = $_POST[ 'order' ];

                        $searchResults = searchPosts( $search, $orderBy, $order, SEARCH_POST_LIMIT ); 
                    }
                ?>
                
                <h1 class="page-header"><?php echo SEARCH_HEAD ?> <small><?php echo SEARCH_DESC ?></small></h1> 
            
                <?php displayPosts( $searchResults ) ?>
                
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>

<?php include "includes/footer.php" ?>