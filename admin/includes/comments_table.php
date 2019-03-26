<!-- CONTENT 
======================================================================-->

<h2>ALL COMMENTS<?php echo $subtitle; ?></h2>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Origin</th>
            <th>Date</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Approve</th>
            <th>Deny</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

       <?php displayCommentsTable( $comments ); ?>
       
    </tbody>
</table>

<!--=====================================================================
 END CONTENT -->

