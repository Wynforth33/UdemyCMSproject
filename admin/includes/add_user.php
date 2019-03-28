<!-- CONTENT 
======================================================================-->

<h2>Create User</h2>

<?php 
//  USER CREATED NOTIFICATION (This handler required here for placement of notification and link)
    if( isset( $_POST[ 'create_user' ] ) ) { 
        echo "User Created: <a href='admin_users.php'>View Users</a>";
    }  
?>

<form action="" method="Post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_fname">First Name</label>
        <input type="text" class="form-control" name="user_fname">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="user_lname">Last Name</label>
        <input type="text" class="form-control" name="user_lname">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role">
            <option value="subscriber">Select Options</option>
              <option value="admin">admin</option>
              <option value="subscriber">subscriber</option>
              <option value="test user">test user</option>
        </select>
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="user_image">Image</label>
        <input type="file" class="form-control" name="user_image">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" id="password" class="form-control" name="user_password">
        <label for="show-password">
            <input type="checkbox" id="show-password" />
            Show Password
        </label>
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="about_me">About Me:</label>
        <textarea rows="3" class="form-control" id="body" name="about_me" value=""></textarea>
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="my_education">My Education:</label>
        <textarea rows="3" class="form-control" id="body" name="my_education" value=""></textarea>
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="my_work">My Work:</label>
        <textarea rows="3" class="form-control" id="body" name="my_work" value=""></textarea>
    </div><!-- .form-group -->

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div><!-- .form-group -->
     
</form>

<!--=====================================================================
END CONTENT -->
