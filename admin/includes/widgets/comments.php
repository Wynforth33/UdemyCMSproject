<?php $comment_count = getCommentCount(); ?>

<div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-comments fa-5x"></i>
                </div><!-- .col-xs-3 -->
                <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $comment_count; ?></div>
                    <div>Comments</div>
                </div><!-- .col-xs-9 -->
            </div><!-- .row -->
        </div><!-- .panel-heading -->
        <a href="admin_comments.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div><!-- .panel-footer -->
        </a>
    </div><!-- .panel -->
</div><!-- .col-lg-3 -->