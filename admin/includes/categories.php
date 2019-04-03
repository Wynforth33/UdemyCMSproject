<div class="well">
       
    <?php $categories = getCategories( SIDE_CAT_LIMIT ); ?>
    
    <h4>Categories</h4>

    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
              
               <?php displayCategoryLinks( $categories ); ?>
               
            </ul>
        </div><!-- .col-lg-6 -->
    </div><!-- .row -->

</div><!-- .well -->