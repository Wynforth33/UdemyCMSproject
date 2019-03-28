<?php 
  
  $draft_post_count          = getDraftPostCount();
  $active_post_count         = getPublishedPostCount();
  $unapproved_comments_count = getUnapprovedCommentCount();
  $subscribers_count         = getSubscribersCount();
  $chart_data = [];
  $chart_row = [];

  $column_text = ['Data', 'All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscribers', 'Categories']; 
  $column_count = ['Count', $post_count, $active_post_count, $draft_post_count, $comment_count, $unapproved_comments_count, $user_count, $subscribers_count, $category_count];

  for ($i = 0; $i < count($column_text); $i++) {
    array_push( $chart_row, $column_text[$i], $column_count[$i] );
    array_push( $chart_data, $chart_row ); 
    $chart_row = [];
  }

  $chart_data_json = json_encode($chart_data);

  echo "<div id='chart_data' data-chart-data='{$chart_data_json}'></div>";

?>

<div class="row">
    <div id="columnchart_material" style="width:'auto'; height: 500px;"></div>
</div>