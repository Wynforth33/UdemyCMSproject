<?php 
  

  $post_query = "SELECT * FROM posts WHERE post_status = 'draft'";
  $draft_posts = mysqli_query($connection, $post_query); 
  $draft_post_count = mysqli_num_rows($draft_posts);

  $comment_query = "SELECT * FROM comments WHERE comment_status = 'Awaiting Approval'";
  $unapproved_comments = mysqli_query($connection, $comment_query); 
  $unapproved_comments_count = mysqli_num_rows($unapproved_comments);

  $user_query = "SELECT * FROM users WHERE user_role = 'subscriber'";
  $subscribers = mysqli_query($connection, $user_query); 
  $subscribers_count = mysqli_num_rows($subscribers);


  $element_text = ['Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscribers', 'Categories']; 
  $element_count = [$post_count, $draft_post_count, $comment_count, $unapproved_comments_count, $user_count, $subscribers_count, $category_count];


?>


<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Data', 'Count'],

    <?php
        for ($i = 0; $i < count($element_text); $i++) {
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