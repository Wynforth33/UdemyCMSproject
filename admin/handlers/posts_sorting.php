<?php
    // 'BY AUTHOR'
    if( isset( $_GET[ 'author' ] ) ) {
        $author = $_GET[ 'author' ];
        $subtitle = ": Author - {$author}";

        $posts = getPostsByAuthor( $author, 'post_date', 'DESC', null );
    }

    // 'BY CATEGORY'
    if( isset( $_GET[ 'category' ] ) ) {
        $cat_id = $_GET[ 'category' ];
        $category = getCategory( $cat_id );
        $subtitle = ": Category - {$category}";

        $posts = getPostsByCategory( $cat_id, 'post_date', 'DESC', null );
    }
?>