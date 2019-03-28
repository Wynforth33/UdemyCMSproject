<form action="" method='post'>

    <h2>ALL POSTS<?php echo $subtitle; ?></h2>

    <table class="table table-bordered table-hover">
        
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control custom-select" name="bulk_options" id="">
                <option value="">Options</option> 
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>       
        </div>

        <div id="bulkOptionsButtons" class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="admin_posts.php?source=add_post&<?php echo $logged_in ?>" class="btn btn-primary">Add New</a>
        </div>

        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
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

</form>


