<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?<?php echo $logged_in; ?>">PHP CMS PROJECT</a>
        </div><!-- .navbar-header -->


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           
           <?php $categories = getCategories( NAV_CAT_LIMIT ) ?>
           
            <ul class="nav navbar-nav">
               
                   <?php displayCategoryLinks( $categories ) ?>
                   
                   <li>
                       <a href="admin/index.php?<?php echo $logged_in; ?>">Admin</a>
                   </li>

                   <?php 
                      if( isset( $user_role ) ) {
                          if ( $user_role === 'admin' && isset( $_GET['post_id'] ) ) {
                              $post_id = escape( $_GET['post_id'] );

                              echo "<li><a href='admin/admin_posts.php?source=edit_post&post_id={$post_id}&{$logged_in}'>Edit Post</a></li>";
                          }
                      }
                   ?>
              
            </ul>
        </div><!-- .navbar-collapse -->
        
    </div><!-- .container -->
</nav>