<?php 
  
  $draft_post_count          = getDraftPostCount();
  $unapproved_comments_count = getUnapprovedCommentCount();
  $subscribers_count         = getSubscribersCount();

  $column_text = ['Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscribers', 'Categories']; 
  $column_count = [$post_count, $draft_post_count, $comment_count, $unapproved_comments_count, $user_count, $subscribers_count, $category_count];

?>

<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Data', 'Count'],

  <?php
      for ($i=0; $i<count($element_text); $i++) {
        echo "['{$element_text[$i]}', {$element_count[$i]}],";
      }
  ?>

    ]);

    var options = {
      chart: {
        title: '',
        subtitle: '',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>

<div class="row">
    <div class="col-lg-12 col-offset-" id="columnchart_material" style="width:'auto'; height: 500px;" ></div>
</div>