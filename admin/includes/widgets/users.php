<?php $user_count = getUserCount(); ?>

<div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                </div><!-- .col-xs-3 -->
                <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $user_count; ?></div>
                    <div> Users</div>
                </div><!-- .col-xs-9 -->
            </div><!-- .row -->
        </div><!-- .panel-heading -->
        <a href="admin_users.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div><!-- .panel-footer -->
        </a>
    </div><!-- .panel -->
</div><!-- .col-lg-3 -->