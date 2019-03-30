 <?php
// DATABASE
    include "db.php";

///////////////////////////////////////////////////////////////////////
// INDEX
// 
// I.   UTILITY FUNCTIONS:
//   I.A   - CONFIRM QUERY
//   I.B   - CLEAN VALUE
//   I.C   - ENCRYPT PASSWORD:
//
// II.   POST FUNCTIONS:
//   II.A  - CREATE POST
//   II.B  - GET POST
//   II.C  - GET POSTS  
//   II.D  - GET POSTS BY CATEGORY
//   II.E  - GET POSTS BY AUTHOR
//   II.F  - GET POST COUNT
//   II.G  - GET DRAFT POST COUNT 
//   II.H  - GET PUBLISHED POST COUNT 
//   II.I  - GET POSTS COUNT: 
//   II.J  - GET POSTS BY PAGE:
//   II.K  - SEARCH POSTS
//   II.L  - (READ) DISPLAY POSTS (GENERAL)
//   II.M  - (READ) DISPLAY POST (GENERAL)
//   II.N  - (READ) DISPLAY POSTS TABLE DATA (ADMIN)
//   II.O  - UPDATE POST
//   II.P  - UPDATE POST STATUS 
//   II.Q  - (UPDATE) INCREMENT POST'S COMMENT COUNTER
//   II.R  - (UPDATE) DECREMENT POST'S COMMENT COUNTER
//   II.S  - (UPDATE) INCREMENT POST'S VIEWS COUNTER:    
//   II.T  - DELETE POST 
//
// III.  CATEGORY FUNCTIONS:
//   III.A - CREATE CATEGORY
//   III.B - GET CATEGORY
//   III.C - GET CATEGORIES
//   III.D - GET CATEGORY COUNT  
//   III.E - (READ) DISPLAY CATEGORY TABLE DATA (ADMIN)
//   III.F - (READ) DISPLAY CATEGORY OPTIONS (ADMIN)
//   III.G - (READ) DISPLAY CATEGORY LINKS (GENERAL)
//   III.H - UPDATE CATEGORY
//   III.I - DELETE CATEGORY
//
// IV.   COMMENT FUNCTIONS:
//   IV.A  - CREATE COMMENT
//   IV.B  - GET COMMENT
//   IV.C  - GET COMMENTS
//   IV.D  - GET COMMENTS BY POST
//   IV.E  - GET APPROVED COMMENTS BY POST (GENERAL)
//   IV.F  - GET COMMENTS BY AUTHOR
//   IV.G  - GET COMMENT COUNT
//   IV.H  - GET UNAPPROVED COMMENT COUNT   
//   IV.I  - (READ) DISPLAY COMMENTS (GENERAL)
//   IV.J  - (READ) DISPLAY COMMENTS TABLE DATA (ADMIN)
//   IV.K  - (UPDATE) APPROVE COMMENT (ADMIN)
//   IV.L  - (UPDATE) DENY COMMENT (ADMIN)
//   IV.M  - DELETE COMMENT (ADMIN)
//   IV.N  - DELETE COMMENTS
//
//  V.   USER FUNCTIONS:
//   V.A   - CREATE USER
//   V.B   - REGISTER USER:
//   V.c   - GET USER
//   V.D   - GET USERS
//   V.E   - GET USER BY USERNAME 
//   V.F   - GET USER COUNT
//   V.G   - GET SUBSCRIBERS COUNT
//   V.H   - SEARCH USER BY USERNAME
//   V.I   - (READ) DISPLAY USERS TABLE DATA ( ADMIN )
//   V.J   - UPDATE USER
//   V.K   - DELETE USER 
//
//  VI.  LOGIN FUNCTIONS:
//   VI.A  - CLEAN LOGIN VALUES
//   VI.B  - GET USER_DATA ARRAY
//   VI.C  - SESSIONIZE USER DATA   
//
//  VII. PROFILE FUNCTIONS:
//   VII.A - CREATE PROFILE
//   VII.B - GET PROFILE
//   VII.C - UPDATE PROFILE 
//
///////////////////////////////////////////////////////////////////////

// ====================================================================
// I.   UTILITY FUNCTIONS
// ====================================================================
   
  // I.A - CONFIRM QUERY:
    function confirmQuery( $result ) {
        global $connection;
        
        // Checks if Query was successful, if not throws error; else returns results.
        if(!$result){
            die("Query Failed!" . mysqli_error($connection));
        }
    }

  // I.B - CLEAN VALUE:
    function cleanString( $string ){
        global $connection;

        $clean_string = mysqli_real_escape_string( $connection, $string );

        return $clean_string;
    }  

  // I.C - ENCRYPT PASSWORD:
    function encryptPassword($password, $cost_param, $salt) {
        $salted_hash = "{$cost_param}{$salt}";
        
        $crypted_password = crypt( $password, $salted_hash );

        return $crypted_password;
    }

// ====================================================================
// II.  POST FUNCTIONS
// ====================================================================

  // II.A - CREATE POST:
    function createPost( $cat_id, $title, $author, $image, $image_desc, $tags, $content ) {
        global $connection; 
        
        $query  = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_image_desc, post_content, post_tags) ";
        $query .= "VALUES ({$cat_id},'{$title}','{$author}', now(),'{$image}','{$image_desc}','{$content}','{$tags}') ";
        
        $result = mysqli_query($connection, $query);
    
        confirmQuery( $result );

        $post_id = mysqli_insert_id($connection);

        return $post_id;
    }

  // II.B - GET POST:
    function getPost( $id ) {
        global $connection;
        
        $query  = "SELECT * FROM posts ";
        $query .= "WHERE post_id = {$id} "; 

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        // Converts $result into an Array and grabs Category Title 
        $post = mysqli_fetch_assoc( $result );
        
        // Checks if Category Title exists; if not throws error;
        // else returns Category Title
        if ( isset( $post ) ) {
            return $post;
        } else {
            echo "No Post Returned!";
        } 
    }
  
  // II.C - GET POSTS:
    function getPosts( $orderBy, $order, $limit ) {
        global $connection;
        
        // Checks if a Post $limit is provided; if so puts $limit on query; 
        // if not grabs all Posts; Orders Post by $orderby, in $order.
        if($limit) {
            // LIMITED QUERY
            $query   = "SELECT * FROM posts ";
            $query  .= "ORDER BY $orderBy $order "; 
            $query  .= "LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query   = "SELECT * FROM posts ";
            $query  .= "ORDER BY $orderBy $order "; 
        }
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }

  // II.D - GET POSTS BY CATEGORY:
    function getPostsByCategory( $cat_id, $orderBy, $order, $limit ) {
        global $connection;
        
        // Checks if a Post $limit is provided; if so puts $limit on query; 
        // if not grabs all Posts; Orders Post by $orderby, in $order.
        if($limit) {
            // LIMITED QUERY
            $query   = "SELECT * FROM posts ";
            $query  .= "WHERE post_category_id = $cat_id ";
            $query  .= "ORDER BY $orderBy $order "; 
            $query  .= "LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query   = "SELECT * FROM posts ";
            $query  .= "WHERE post_category_id = $cat_id ";
            $query  .= "ORDER BY $orderBy $order "; 
        }
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }

  // II.E - GET POSTS BY AUTHOR:
    function getPostsByAuthor( $author, $orderBy, $order, $limit ) {
        global $connection;
        
        // Checks if a Post $limit is provided; if so puts $limit on query; 
        // if not grabs all Posts; Orders Post by $orderby, in $order.
        if($limit) {
            // LIMITED QUERY
            $query   = "SELECT * FROM posts ";
            $query  .= "WHERE post_author = '$author' ";
            $query  .= "ORDER BY $orderBy $order "; 
            $query  .= "LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query   = "SELECT * FROM posts ";
            $query  .= "WHERE post_author = '$author' ";
            $query  .= "ORDER BY $orderBy $order "; 
        }
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }

  // II.F - GET POST COUNT:
    function getPostCount() {
        global $connection;
        
        $query  = "SELECT * FROM posts ";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    }    

  // II.G - GET DRAFT POST COUNT:
    function getDraftPostCount() {
        global $connection;
        
        $query  = "SELECT * FROM posts WHERE post_status = 'draft'";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    }    

  // II.H - GET PUBLISHED POST COUNT:
    function getPublishedPostCount() {
        global $connection;
        
        $query  = "SELECT * FROM posts WHERE post_status = 'published'";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    }    

  // II.I - GET POSTS COUNT:
    function getPostsCount() {
        global $connection;
        
        $query  = "SELECT * FROM posts ";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    }      

  // II.J - GET POSTS BY PAGE:
    function getPostsByPage( $page ) {
        global $connection;

        $index = ($page-1) * 5; 
        
        $query  = "SELECT * FROM posts LIMIT {$index}, 5 ";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }  

  // II.K - SEARCH POSTS:
    function searchPosts( $search, $orderBy, $order, $limit ) {
        global $connection;
        
        // Checks if a Post Limit is provided; if so puts limit on Query; 
        // if not Queries all Posts; ORDERS BY Date returns most recent first. 
        if( $limit ) {
            // LIMITED QUERY
            $query  = "SELECT * FROM posts ";
            $query .= "WHERE post_title LIKE '%$search%' ";
            $query .= "OR post_author LIKE '%$search%' ";
            $query .= "OR post_content LIKE '%$search%' ";
            $query .= "OR post_tags LIKE '%$search%' ";
            $query .= "ORDER BY $orderBy $order "; 
            $query .= "LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query  = "SELECT * FROM posts ";
            $query .= "WHERE post_title LIKE '%$search%' ";
            $query .= "OR post_author LIKE '%$search%' ";
            $query .= "OR post_content LIKE '%$search%' ";
            $query .= "OR post_tags LIKE '%$search%' ";
            $query .= "ORDER BY $orderBy $order "; 
        }

        $result = mysqli_query( $connection, $query );

        confirmQuery( $result );

        // Checks Number of Results returned, if no results found, will notify user;
        // if results returned, returns results.
        $count = mysqli_num_rows( $result );

        if( $count == 0 ) {
            return 0;
        } else {
            return $result;
        }   
    }

  // II.L - (READ) DISPLAY POSTS ( GENERAL ):
    function displayPosts( $posts ) {  
        global $logged_in;
        $counter = 0;
        $logged_in_post = "";
            
        if ($logged_in) {
            $logged_in_post = "&{$logged_in}";
        }

        if ( !$posts) {
            echo "There are no Posts that match current Search Parameters!"; 
        } else {
            while ( $row = mysqli_fetch_assoc( $posts ) ) {
                 $post_id            = $row['post_id'];
                 $post_title         = $row['post_title'];
                 $post_author        = $row['post_author'];
                 $post_date          = $row['post_date'];
                 $post_image         = $row['post_image'];
                 $post_image_desc    = $row['post_image_desc'];
                 $post_status        = $row['post_status'];
                 $post_excerpt     = substr($row['post_content'],0,88);
            ?>
            <?php if ( $post_status === 'published' ) : ?>
                    <!-- BLOG POST TEMPLATE -->
                    <h2><a href="post.php?post_id=<?php echo $post_id; ?><?php echo $logged_in_post; ?>"><?php echo $post_title ?></a></h2>
                    <p class="lead">by <a href="author.php?author=<?php echo $post_author ?><?php echo $logged_in_post; ?>"><?php echo $post_author ?></a></p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>

                    <hr>
            
                <!-- Check if Post has an Image; if no image, nothing is Supplied -->        
                <?php if ($post_image) : ?>
                    <a href="post.php?post_id=<?php echo $post_id ?><?php echo $logged_in_post; ?>">
                       <img width="900" class="img-responsive" src="images/<?php echo $post_image ?>" alt="<?php echo $post_image_desc ?>">
                    </a>    
                        
                <?php endif ?>
                    
                    <hr>

                    <p><?php echo $post_excerpt ?> ...</p>
                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?><?php echo $logged_in_post; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>  

                <?php 

                endif; 
            } 
        }
    }

  // II.M - (READ) DISPLAY POST ( GENERAL ):
    function displayPost( $post ) { 
                global $logged_in;        
                 $post_id            = $post['post_id'];
                 $post_title         = $post['post_title'];
                 $post_author        = $post['post_author'];
                 $post_date          = $post['post_date'];
                 $post_image         = $post['post_image'];
                 $post_image_desc    = $post['post_image_desc'];
                 $post_content       = $post['post_content'];
                 $post_views_count   = $post['post_views_count'];

                 $logged_in_post = null;

                if ($logged_in) {
                    $logged_in_post = "&{$logged_in}";
                }?>
                      
                    <!-- BLOG POST TEMPLATE -->
                    <h1 class="page-header"><?php echo $post_title; ?></h1>
                    <p class="lead">by <a href="author.php?author=<?php echo $post_author; ?><?php echo $logged_in_post; ?>"><?php echo $post_author; ?></a></p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> | <span class="glyphicon glyphicon-eye-open"></span> <?php echo $post_views_count ?> </p>

                    <hr>
            
                <!-- Check if Post has an Image; if no image nothing is Supplied -->        
                <?php if ($post_image) : ?>
                    
                    <img width="600" class="img-responsive" src="images/<?php echo $post_image ?>" alt="<?php echo $post_image_desc ?>">      
                        
                <?php endif ?>
                    
                    <hr>

                    <p><?php echo $post_content ?></p>   
                    
                    <hr> <?php         
    }     

  // II.N - (READ) DISPLAY POSTS TABLE DATA ( ADMIN ):
    function displayPostsTable( $posts ) {  
        global $logged_in;
        $logged_in_post = null;

        if ($logged_in) {
            $logged_in_post = "&{$logged_in}";
        } 

        while ( $row = mysqli_fetch_assoc( $posts ) ) {
            $post_id            = $row['post_id'];
            $post_author        = $row['post_author'];
            $post_title         = $row['post_title'];
            $post_category_id   = $row['post_category_id'];
            $post_date          = $row['post_date'];
            $post_image         = $row['post_image'];
            $post_image_desc    = $row['post_image_desc'];
            $post_tags          = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_views_count   = $row['post_views_count'];
            $post_status        = $row['post_status'];

            $cat_title = getCategory( $post_category_id );
        
            $table_row  = "<tr>";
            $table_row .= "<td><input name='checkBoxArray[]' class='checkBoxes' type='checkbox' value='{$post_id}'></td>";
            $table_row .= "<td>{$post_id}</td>";
            $table_row .= "<td><a href='admin_posts.php?author={$post_author}{$logged_in_post}'>{$post_author}</td>";
            $table_row .= "<td><a href='../post.php?post_id={$post_id}{$logged_in_post}'>{$post_title}</a></td>";
            $table_row .= "<td><a href='admin_posts.php?category={$post_category_id}{$logged_in_post}'>{$cat_title}</td>";
            $table_row .= "<td>{$post_status}</td>";
            $table_row .= "<td><img width='100' src='../images/{$post_image}' alt='{$post_image_desc}'></td>";
            $table_row .= "<td>{$post_tags}</td>";
            $table_row .= "<td>{$post_comment_count}</td>";
            $table_row .= "<td>{$post_views_count}</td>";
            $table_row .= "<td>{$post_date}</td>";
            $table_row .= "<td><a href='admin_posts.php?source=edit_post&post_id={$post_id}{$logged_in_post}'>Edit</td>";
            $table_row .= "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='admin_posts.php?delete={$post_id}{$logged_in_post}'>Delete</td>";
            $table_row .= "</tr>";
        
            echo $table_row; 
        }
    }

  // II.O - UPDATE POST:
    function updatePost( $cat_id, $title, $status, $author, $image, $image_desc, $tags, $content, $post_id ) {
        global $connection;
        global $logged_in;
        
        // CHECKS if $image Parameter is empty, if so query's database for existing image. 
        if(empty($image)) {
            $image_query  = "SELECT * FROM posts ";
            $image_query .= "WHERE post_id = {$post_id}";
            
            $missing_image = mysqli_query($connection, $image_query);
            
            confirmQuery( $missing_image );
            
            $row = mysqli_fetch_array($missing_image); 
            
            $image = $row['post_image'];
        }
        
        $query  = "UPDATE posts SET ";
        $query .= "post_category_id = '{$cat_id}', ";
        $query .= "post_title = '{$title}', ";
        $query .= "post_date = now(), ";
        $query .= "post_status = '{$status}', ";
        $query .= "post_author = '{$author}', "; 
        $query .= "post_image = '{$image}', "; 
        $query .= "post_image_desc = '{$image_desc}', "; 
        $query .= "post_tags = '{$tags}', "; 
        $query .= "post_content = '{$content}' ";
        $query .= "WHERE post_id = {$post_id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    }

  // II.P - UPDATE POST STATUS: 
    function updatePostStatus( $post_id, $option ) {
        global $connection;
        global $logged_in;
        
        $query  = "UPDATE posts SET ";
        $query .= "post_status = '{$option}' ";
        $query .= "WHERE post_id = {$post_id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );

        // REFRESHES THE PAGE
        header("location: admin_posts.php?{$logged_in}");
    }
  
  // II.Q - (UPDATE) INCREMENT POST'S COMMENT COUNTER:
    function incrementCommentCount( $post_id ) {
        global $connection;
        
        $post = getPost($post_id);
        $post_comment_count = $post['post_comment_count'];
        $post_comment_count++; 
        
        $query  = "UPDATE posts SET ";
        $query .= "post_comment_count = {$post_comment_count} ";
        $query .= "WHERE post_id = {$post_id} ";
        
        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    }

  // II.R - (UPDATE) DECREMENT POST'S COMMENT COUNTER:
    function decrementCommentCount( $post_id ) {
        global $connection;
        
        $post = getPost($post_id);
        $post_comment_count = $post['post_comment_count'];
        $post_comment_count--; 
        
        $query  = "UPDATE posts SET ";
        $query .= "post_comment_count = {$post_comment_count} ";
        $query .= "WHERE post_id = {$post_id} ";
        
        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    }

  // II.S - (UPDATE) INCREMENT POST'S VIEWS COUNTER:
    function incrementViewsCount( $post_id ) {
        global $connection;
        
        $query  = "UPDATE posts SET ";
        $query .= "post_views_count = post_views_count + 1 ";
        $query .= "WHERE post_id = {$post_id} ";
        
        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    }  

  // II.T - DELETE POST:
    function deletePost( $id ) {
        global $logged_in;
        global $connection;

        $query  = "DELETE FROM posts ";
        $query .= "WHERE post_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );

        deleteComments($id);
        
        // REFRESHES THE PAGE
        header("location: admin_posts.php?{$logged_in}");
    }

// ====================================================================
// III. CATEGORY FUNCTIONS
// ====================================================================

  // III.A - CREATE CATEGORY:
    function createCategory( $title ) {
        global $connection;
        global $logged_in;

        if( $title == "" || empty( $title ) ) {

            echo "This field should not be Empty!";

        } else {
            $query  = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('{$title}') "; 

            $result = mysqli_query( $connection, $query );

            confirmQuery( $result );
        }
        
        // REFRESHES THE PAGE
        header("location: admin_categories.php?{$logged_in}");
    }

  // III.B - GET CATEGORY:
    function getCategory( $id ) {
        global $connection;
        
        $query  = "SELECT * FROM categories ";
        $query .= "WHERE cat_id = {$id} "; 

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        // Converts $result into an Array and grabs Category Title 
        $row = mysqli_fetch_assoc( $result );
        $title = $row['cat_title'];
        
        // Checks if Category Title exists; if not throws error;
        // else returns Category Title
        if ( isset( $title ) ) {
            return $title;
        } else {
            echo "Category No Longer Exists!";
        } 
    }
  
  // III.C - GET CATEGORIES: 
    function getCategories( $limit ) {
        global $connection;
        
        // Checks if a Category $limit is provided; if so puts $limit on query; 
        // if not grabs all categories.
        if($limit) {
            // LIMITED QUERY
            $query  = "SELECT * FROM categories LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query = "SELECT * FROM categories"; 
        }
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }

  // III.D- GET CATEGORY COUNT:
    function getCategoryCount() {
        global $connection;
        
        $query   = "SELECT * FROM categories ";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    } 

  // III.E - (READ) DISPLAY CATEGORY TABLE DATA:
    function displayCategoryTable( $categories ) {
        global $logged_in;
        $logged_in_cat = null;

         if ($logged_in) {
            $logged_in_cat = "&{$logged_in}";
        }

         while ( $row = mysqli_fetch_assoc( $categories ) ) {
             $cat_id    = $row['cat_id'];
             $cat_title = $row['cat_title'];
             
             
             $table_row  = "<tr>";
             $table_row .= "<td>{$cat_id}</td>";
             $table_row .= "<td><a href='../category.php?category={$cat_id}{$logged_in_cat}'>{$cat_title}</td>";
             $table_row .= "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='admin_categories.php?delete={$cat_id}{$logged_in_cat}'>Delete</td>";
             $table_row .= "<td><a href='admin_categories.php?edit={$cat_id}{$logged_in_cat}'>Edit</td>";
             $table_row .= "</tr>";
             
             echo $table_row;
         }
    }

  // III.F - (READ) DISPLAY CATEGORY OPTIONS:
    function displayCategoryOptions( $categories ) {
         while ( $row = mysqli_fetch_assoc( $categories ) ) {
             $cat_id    = $row['cat_id'];
             $cat_title = $row['cat_title'];
             
             $option = "<option value='{$cat_id}'>{$cat_title}</option>";
             
             echo $option;
         }
    }

  // III.G - DISPLAY CATEGORY LINKS:
    function displayCategoryLinks( $categories ) {
        global $logged_in;
        $logged_in_cat = null;

        if ($logged_in) {
            $logged_in_cat = "&{$logged_in}";
        }
    
        while ( $row = mysqli_fetch_assoc( $categories ) ) {
            $cat_title = $row['cat_title'];
            $cat_id    = $row['cat_id'];
            

            echo "<li><a href='category.php?category={$cat_id}{$logged_in_cat}'>{$cat_title}</a></li>";
        }
    }

  // III.H - UPDATE CATEGORY:
    function updateCategory( $id, $title ) {
        global $logged_in;
        global $connection;

        $query  = "UPDATE categories "; 
        $query .= "SET cat_title = '{$title}' "; 
        $query .= "WHERE cat_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    
        // REFRESHES THE PAGE
        header("location: admin_categories.php?{$logged_in}");
    }
  
  // III.I - DELETE CATEGORY:
    function deleteCategory( $id ) {
        global $logged_in;
        global $connection;
        
        $delete_id = $_GET['delete'];

        $query  = "DELETE FROM categories ";
        $query .= "WHERE cat_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
        
        // REFRESHES THE PAGE
        header("location: admin_categories.php?{$logged_in}");
    }

// ====================================================================
// IV.  COMMENT FUNCTIONS
// ====================================================================

  // Iv.A - CREATE COMMENT: 
    function createComment( $post_id, $author, $email, $content ) {
        global $connection; 
        
        $query  = "INSERT INTO comments(comment_post_id, comment_date, comment_author, comment_email, comment_content) ";
        $query .= "VALUES ({$post_id}, now(), '{$author}', '{$email}', '{$content}') ";
    
        $result = mysqli_query($connection, $query);
    
        confirmQuery( $result );
        
        incrementCommentCount( $post_id );
    }

  // IV.B - GET COMMENT:
    function getComment( $id ) {
        global $connection;
        
        $query  = "SELECT * FROM comments ";
        $query .= "WHERE post_id = {$id} "; 

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        // Converts $result into an Array and grabs Category Title 
        $comment = mysqli_fetch_assoc( $result );
        
        // Checks if Category Title exists; if not throws error;
        // else returns Category Title
        if ( isset( $comment ) ) {
            return $comment;
        } else {
            echo "Comment No Longer Exists!";
        } 
    }

  // IV.C - GET COMMENTS:
    function getComments( $orderBy, $order, $limit ) {
        global $connection;
        
        // Checks if a Post $limit is provided; if so puts $limit on query; 
        // if not grabs all Posts; Orders Post by $orderby, in $order.
        if($limit) {
            // LIMITED QUERY
            $query   = "SELECT * FROM comments ";
            $query  .= "ORDER BY $orderBy $order "; 
            $query  .= "LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query   = "SELECT * FROM comments ";
            $query  .= "ORDER BY $orderBy $order "; 
        }
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }
  
  // IV.D - GET COMMENTS BY POST (ADMIN):
    function getCommentsByPost( $post_id, $orderBy, $order, $limit ) {
        global $connection;
        
        // Checks if a Post $limit is provided; if so puts $limit on query; 
        // if not grabs all Posts; Orders Post by $orderby, in $order.
        if($limit) {
            // LIMITED QUERY
            $query   = "SELECT * FROM comments ";
            $query  .= "WHERE comment_post_id = $post_id ";
            $query  .= "ORDER BY $orderBy $order "; 
            $query  .= "LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query   = "SELECT * FROM comments ";
            $query  .= "WHERE comment_post_id = $post_id ";
            $query  .= "ORDER BY $orderBy $order "; 
        }
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }

  // IV.E - GET APPROVED COMMENTS BY POST (GENERAL):
    function getApprovedCommentsByPost( $post_id, $orderBy, $order, $limit ) {
        global $connection;
        
        // Checks if a Post $limit is provided; if so puts $limit on query; 
        // if not grabs all Posts; Orders Post by $orderby, in $order.
        if($limit) {
            // LIMITED QUERY
            $query   = "SELECT * FROM comments ";
            $query  .= "WHERE comment_post_id = $post_id ";
            $query  .= "AND comment_status = 'Approved' ";
            $query  .= "ORDER BY $orderBy $order "; 
            $query  .= "LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query   = "SELECT * FROM comments ";
            $query  .= "WHERE comment_post_id = $post_id ";
            $query  .= "AND comment_status = 'Approved' ";
            $query  .= "ORDER BY $orderBy $order "; 
        }
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }

  // IV.F - GET COMMENTS BY AUTHOR:
    function getCommentsByAuthor( $author, $orderBy, $order, $limit ) {
        global $connection;
        
        // Checks if a Post $limit is provided; if so puts $limit on query; 
        // if not grabs all Posts; Orders Post by $orderby, in $order.
        if($limit) {
            // LIMITED QUERY
            $query   = "SELECT * FROM comments ";
            $query  .= "WHERE comment_author = '$author' ";
            $query  .= "ORDER BY $orderBy $order "; 
            $query  .= "LIMIT $limit ";
        } else {
            // LIMITLESS QUERY
            $query   = "SELECT * FROM comments ";
            $query  .= "WHERE comment_author = '$author' ";
            $query  .= "ORDER BY $orderBy $order "; 
        }
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }

  // IV.G - GET COMMENT COUNT:
    function getCommentCount() {
        global $connection;
        
        $query  = "SELECT * FROM comments ";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    }  

  // IV.H - GET UNAPPROVED COMMENT COUNT:
    function getUnapprovedCommentCount() {
        global $connection;
        
        $query   = "SELECT * FROM comments WHERE comment_status = 'Awaiting Approval'";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    }   

  // IV.I - (READ) DISPLAY COMMENTS (GENERAL):
    function displayComments( $comments ) {    
        while ( $row = mysqli_fetch_assoc( $comments ) ) {
                 $comment_id      = $row['comment_id'];
                 $comment_author  = $row['comment_author'];
                 $comment_date    = $row['comment_date'];
                 $comment_content = $row['comment_content'];
            ?>
               
                <!-- Comment -->
                <div class="media">
                   
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    
                    <div class="media-body">
                       
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        
                        <?php echo $comment_content; ?>
                        
                    </div><!-- .media-body -->
                </div> <!-- .media -->            
               
      <?php }   
    }

  // IV.J - (READ) DISPLAY COMMENTS TABLE DATA ( ADMIN ):
    function displayCommentsTable( $comments ) {
        global $logged_in; 
        $logged_in_com = null;

        if ($logged_in) {
            $logged_in_com = "&{$logged_in}";
        }   

        while ( $row = mysqli_fetch_assoc( $comments ) ) {
            $comment_id      = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_date    = $row['comment_date'];
            $comment_author  = $row['comment_author'];
            $comment_email   = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status  = $row['comment_status'];
            
            
            $post       = getPost( $comment_post_id );
            $post_title = $post['post_title'];
            
            $table_row  = "<tr>";
            $table_row .= "<td>{$comment_id}</td>";
            $table_row .= "<td><a href='admin_comments.php?post_id={$comment_post_id}{$logged_in_com}'>{$post_title}</a><hr>";
            $table_row .= "<a class='btn btn-xs btn-default' href='../post.php?post_id={$comment_post_id}{$logged_in_com}'>Go To Post</a></td>";
            $table_row .= "<td>{$comment_date}</td>";
            $table_row .= "<td><a href='admin_comments.php?author={$comment_author}{$logged_in_com}'>{$comment_author}</a></td>";
            $table_row .= "<td>{$comment_email}</td>";
            $table_row .= "<td>{$comment_content}</td>";
            $table_row .= "<td>{$comment_status}</td>";
            $table_row .= "<td><a href='admin_comments.php?approve={$comment_id}{$logged_in_com}'>Approve</a></td>";
            $table_row .= "<td><a href='admin_comments.php?deny={$comment_id}{$logged_in_com}'>Deny</a></td>";
            $table_row .= "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='admin_comments.php?delete={$comment_id}&post_id={$comment_post_id}{$logged_in_com}'>Delete</a></td>";
            $table_row .= "</tr>";
        
            echo $table_row;
        }
    }

  // IV.K - (UPDATE) APPROVE COMMENT:
    function approveComment( $id ) {
        global $logged_in;
        global $connection;
      
        $query  = "UPDATE comments SET ";
        $query .= "comment_status = 'Approved' ";
        $query .= "WHERE comment_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    
        // REFRESHES THE PAGE
        header("location: admin_comments.php?{$logged_in}");
    }

  // IV.L - (UPDATE) DENY COMMENT:
    function denyComment( $id ) {
        global $logged_in;
        global $connection;
      
        $query  = "UPDATE comments SET ";
        $query .= "comment_status = 'Denied' ";
        $query .= "WHERE comment_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    
        // REFRESHES THE PAGE
        header("location: admin_comments.php{?$logged_in}");
    }

  // IV.M - DELETE COMMENT:
    function deleteComment( $post_id, $id ) {
        global $logged_in;
        global $connection;

        $query  = "DELETE FROM comments ";
        $query .= "WHERE comment_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
        
        decrementCommentCount( $post_id );
        
        // REFRESHES THE PAGE
        header("location: admin_comments.php?{$logged_in}");
    }

  // IV.N - DELETE COMMENTS
    function deleteComments( $post_id ) {
        global $logged_in;
        global $connection;

        $query  = "DELETE FROM comments ";
        $query .= "WHERE comment_post_id = {$post_id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    }    

// ====================================================================
// V.   USER FUNCTIONS
// ====================================================================

  // V.A - CREATE USER:
    function createUser( $username, $password, $fname, $lname, $email, $image='', $role='' ) {
        global $connection; 
        
        $query  = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
        $query .= "VALUES ('{$username}','{$password}','{$fname}','{$lname}','{$email}','{$image}','{$role}') ";
        
        $result = mysqli_query($connection, $query);
    
        confirmQuery( $result );

        $user_id = mysqli_insert_id($connection);

        return $user_id; 
    }

  // V.B - REGISTER USER:
    function registerUser( $username, $email, $password ){
        global $connection;

        $query  = "INSERT INTO users(username, user_password, user_email) ";
        $query .= "VALUES ('{$username}','{$password}','{$email}') ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );

        $user_id = mysqli_insert_id($connection);

        return $user_id; 
    }  

  // V.C - GET USER:
    function getUser( $id ) {
        global $connection;
        
        $query  = "SELECT * FROM users ";
        $query .= "WHERE user_id = {$id} "; 

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        // Converts $result into an Array and grabs Category Title 
        $user = mysqli_fetch_assoc( $result );
        
        // Checks if Category Title exists; if not throws error;
        // else returns Category Title
        if ( isset( $user ) ) {
            return $user;
        } else {
            echo "No User Returned!";
        } 
    }

  // V.D - GET USERS:
    function getUsers() {
        global $connection;

        $query = "SELECT * FROM users";
        
        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        return $result;
    }

  // V.E - GET USER BY USERNAME:
    function getUserByUsername( $username ) {
        global $connection;

        $exists = searchForUserByUsername( $username );

        if (!$exists) {
            return 0;
        }
        
        $query  = "SELECT * FROM users ";
        $query .= "WHERE username = '{$username}' "; 

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );

        return $result; 
    }

  // V.F - GET USER COUNT:
    function getUserCount() {
        global $connection;
        
        $query   = "SELECT * FROM users ";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    }

  // V.G - GET SUBSCRIBERS COUNT:
    function getSubscribersCount() {
        global $connection;
        
        $query  = "SELECT * FROM users WHERE user_role = 'subscriber'";

        $result = mysqli_query( $connection, $query );
        
        confirmQuery( $result );
        
        $count = mysqli_num_rows($result);

        return $count;
    }      

  // V.H - SEARCH USER BY USERNAME: (Returns 0 if user does not exist and 1 if user does exist);
    function searchForUserByUsername( $username ) {
        global $connection;

        $query  = "SELECT * FROM users ";
        $query .= "WHERE username LIKE '$username' ";

        $result = mysqli_query( $connection, $query );

        if(!$result){
            echo "Doesn't Exist!";
            return 0;
        } else {
            echo "Does Exist!";
            return 1; 
        }
    }

  // V.I - (READ) DISPLAY USERS TABLE DATA ( ADMIN ):
    function displayUsersTable( $users ) { 
        global $logged_in; 

        while ( $row = mysqli_fetch_assoc( $users ) ) {
            $user_id  = $row['user_id'];
            $username = $row['username'];
            //$password = $row['user_password'];
            $fname    = $row['user_firstname'];
            $lname    = $row['user_lastname'];
            $email    = $row['user_email'];
            $image    = $row['user_image'];
            $role     = $row['user_role'];
            //$randSalt = $row['randSalt'];
      
            $table_row  = "<tr>";
            $table_row .= "<td>{$user_id}</td>";
            $table_row .= "<td>{$username}</td>";
            $table_row .= "<td>{$fname}</td>";
            $table_row .= "<td>{$lname}</td>";
            $table_row .= "<td>{$email}</td>";
            $table_row .= "<td>{$role}</td>";
            $table_row .= "<td><a href='admin_users.php?source=edit_user&user_id={$user_id}&{$logged_in}'>Edit</a></td>";
            $table_row .= "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='admin_users.php?delete={$user_id}'>Delete</a></td>";
            $table_row .= "</tr>";
        
            echo $table_row; 
        }
    }

  // V.J - UPDATE USER:
    function updateUser( $id, $username, $password, $fname, $lname, $email, $image, $role ) {
        global $logged_in;
        global $connection;
        
      // CHECKS if $image Parameter is empty, if so query's database for existing image. 
        if(empty($image)) {
            $image_query  = "SELECT * FROM users ";
            $image_query .= "WHERE user_id = {$id}";
            
            $missing_image = mysqli_query($connection, $image_query);
            
            confirmQuery( $missing_image );
            
            $row = mysqli_fetch_array($missing_image); 
            
            $image = $row['user_image'];
        }
        
        $query  = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$password}', ";
        $query .= "user_firstname = '{$fname}', "; 
        $query .= "user_lastname = '{$lname}', "; 
        $query .= "user_email = '{$email}', "; 
        $query .= "user_image = '{$image}', "; 
        $query .= "user_role = '{$role}' ";
        $query .= "WHERE user_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    
      // REFRESHES THE PAGE
        header("location: admin_users.php?{$logged_in}");
    }  

  // V.K - DELETE USER:
    function deleteUser( $id ) {
        global $logged_in;
        global $connection;

        $query  = "DELETE FROM users ";
        $query .= "WHERE user_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );

        $query_profile  = "DELETE FROM profiles ";
        $query_profile .= "WHERE user_profile_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );

        // REFRESHES THE PAGE
        header("location: admin_users.php?{$logged_in}");
    }

// ====================================================================
// VI.  LOGIN FUNCTIONS
// ====================================================================

  // VI.A - CLEAN LOGIN VALUES:
    function cleanLoginValues($username, $password) {
        global $connection;

        $safe_username = mysqli_real_escape_string( $connection, $username );
        $safe_password = mysqli_real_escape_string( $connection, $password );

        $safe_user['username'] = $safe_username;
        $safe_user['password'] = $safe_password;

        return $safe_user; 
    }

  // VI.B - GET USER_DATA ARRAY:
    function getUserDataArray( $username ) {

        $result = getUserByUsername( $username );

        if(!$result) {
            return 0;
        }

        $user_data = mysqli_fetch_assoc( $result );

        return $user_data; 
    } 

  // VI.C - SESSIONIZE USER DATA:
    function sessionizeUserData($user_data) {
        $_SESSION[ 'id' ]       = $user_data['user_id'];
        $_SESSION[ 'username' ] = $user_data['username'];
        $_SESSION[ 'fname' ]    = $user_data['user_firstname'];
        $_SESSION[ 'lname' ]    = $user_data['user_lastname'];
        $_SESSION[ 'role' ]     = $user_data['user_role'];
    }   

// ====================================================================
// VII.  PROFILE FUNCTIONS
// ====================================================================

  // VII.A - CREATE PROFILE:
    function createProfile( $id, $about='', $education='', $work='') {
        global $connection; 
        
        $query  = "INSERT INTO profiles(user_profile_id, about_me, my_education, my_work) ";
        $query .= "VALUES ('{$id}','{$about}','{$education}','{$work}') ";
        
        $result = mysqli_query($connection, $query);
    
        confirmQuery( $result );
    }

  // VII.B - GET PROFILE:
    function getProfile($id){
        global $connection;

        $query  = "SELECT * FROM profiles ";
        $query .= "WHERE user_profile_id = '{$id}' ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );

        $user_profile = mysqli_fetch_assoc( $result );

        return $user_profile;
    }  

  // VII.C - UPDATE PROFILE
    function updateProfile( $id, $username, $password, $fname, $lname, $email, $image, $role, $about='', $education='', $work='' ) {
        global $logged_in;
        global $connection;

      // UPDATES USER DATA 
        // CHECKS if $image Parameter is empty, if so query's database for existing image. 
        if(empty($image)) {
            $image_query  = "SELECT * FROM users ";
            $image_query .= "WHERE user_id = {$id}";
            
            $missing_image = mysqli_query($connection, $image_query);
            confirmQuery( $missing_image );
            $row = mysqli_fetch_array($missing_image); 
            $image = $row['user_image'];
        }
        
        $query  = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$password}', ";
        $query .= "user_firstname = '{$fname}', "; 
        $query .= "user_lastname = '{$lname}', "; 
        $query .= "user_email = '{$email}', "; 
        $query .= "user_image = '{$image}', "; 
        $query .= "user_role = '{$role}' ";
        $query .= "WHERE user_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
        
      // UPDATES USER PROFILE DATA    
        $query  = "UPDATE profiles SET ";
        $query .= "about_me = '{$about}', ";
        $query .= "my_education = '{$education}', "; 
        $query .= "my_work = '{$work}', "; 
        $query .= "WHERE user_profile_id = {$id} ";

        $result = mysqli_query($connection, $query);

        confirmQuery( $result );
    
      // REFRESHES THE PAGE
        header("location: admin_profile.php?{$logged_in}");
    }

?>                                      