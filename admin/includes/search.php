<div class="well">

    <h4>Search</h4>

    <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div><!-- .input-group -->
        <div class="input-group">
            <h5>Order Results By: </h5>
            <div class="row">
                <div class="col-md-6">
                    <select name="orderBy">
                        <option value="post_date">Date</option>
                        <option value="post_title">Title</option>
                        <option value="post_author">Author</option>
                    </select>
                </div><!-- .col-md-6 -->
                <div class="col-md-6">
                    <select name="order">
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                </div><!-- .col-md-6 -->
            </div><!-- .row -->
        </div><!-- .input-group -->
    </form>

</div><!-- .well -->