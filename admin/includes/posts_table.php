<!-- CONTENT 
======================================================================-->

<h2>ALL POSTS<?php echo $subtitle; ?></h2>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

       <?php displayPostsTable( $posts ); ?>
       
    </tbody>
</table>

<!--=====================================================================
 END CONTENT -->

