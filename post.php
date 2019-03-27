<?php define("TITLE", "POST | PHP CMS Project") ?>
    
<!-- WEB PAGE  -->
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navbar.php" ?>

    <!-- Page Content -->
    <div class="container">
       
        <div class="row">

            <!-- POST Column -->
            <div class="col-md-8">
                
                <?php
                    if( isset( $_GET[ 'post_id' ] ) ) {
                        $post_id = $_GET[ 'post_id' ];
                        $post = getPost( $post_id );
                    }  
                ?>
                
                <?php displayPost( $post ) ?>
                   
                <!-- Post Comments -->
                <?php include "includes/comments.php" ?>   
                    
            </div> <!-- .col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div><!-- .row -->

        <hr>

<?php include "includes/footer.php" ?>