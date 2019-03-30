<nav aria-label="Home Page Navigation">
  <ul class="pagination">
    <?php
        $page_count = ceil( $post_count / 5 );
        $pages_left = $page_count - $page;
        $isLogged = "";

        // Modify $logged_in to be passed Correctly by links; so that if the user is not logded in Null is sent. 
        if($logged_in){
            $isLogged = "&{$logged_in}"; 
        }

      // Check if PAGE is greater than 1; if so adds two links for START and PREV. 
        if( $page > 1 ) {
            echo "<li class='page-item'><a class='page-link' href='index.php?page=1{$isLogged}'>Start</li>";
        }

      // Check if PAGE is greater than 1; if so adds two links for START and PREV. 
        if( $page > 2 ) {
            $prev_page = $page - 1;
            echo "<li class='page-item'><a class='page-link' href='index.php?page={$prev_page}{$isLogged}'>Previous</li>";
        }

      // IF MORE THAN 5 PAGES LEFT, LIMITS BUTTONS TO NEXT 5 PAGES
        if ( $pages_left > 5 ) {

            for($i = $page; $i<$page+5; $i++){

              // IF $i is equal to $PAGE echo .active link; else normal link
                if( $i === $page ){
                    echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}{$isLogged}'>{$i}</li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}{$isLogged}'>{$i}</li>";
                }
            }

      // IF LESS GREATER THAN ZERO AND LESS THAN 5 DISPLAYS ALL PAGES     
        } elseif ( $page_count > 0 && $page_count ) {

            for($i = $page; $i<=$page_count; $i++){

              // IF $i is equal to $PAGE echo .active link; else normal link
                if( $i === $page ){
                    echo "<li class='page-item active'><a class='page-link active' href='index.php?page={$i}{$isLogged}'>{$i}</li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}{$isLogged}'>{$i}</li>";
                }
            }
        }
    ?>
  </ul>
</nav>