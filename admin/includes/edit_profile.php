<!-- CONTENT 
======================================================================-->
<h2>Edit Profile</h2>
  
<form action="admin_profile.php?<?php echo $logged_in; ?>" method="Post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_fname">First Name</label>
        <input type="text" class="form-control" name="user_fname" value="<?php echo $user[ 'user_firstname' ]; ?>">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="user_lname">Last Name</label>
        <input type="text" class="form-control" name="user_lname" value="<?php echo $user[ 'user_lastname' ]; ?>">
    </div><!-- .form-group -->
    
    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role">
            <option value="<?php echo $user[ 'user_role' ]; ?>"><?php echo $user[ 'user_role' ]; ?></option>

            <?php if ( $user[ 'user_role' ] === 'admin' ) : ?>
              
              <option value="subscriber">subscriber</option>
              <option value="test user">test user</option>

            <?php elseif ( $user[ 'user_role' ] === 'subscriber' ) : ?>

              <option value="admin">admin</option>
              <option value="test user">test user</option>

            <?php else : ?>

              <option value="admin">admin</option>
              <option value="test user">subscriber</option>  

            <?php endif; ?>
        </select>
    </div><!-- .form-group -->
    
    <div class="form-group">
        <img width="100" src="../images/<?php echo $user[ 'user_image' ]; ?>">
        <input type="file" class="form-control" name="user_image">
    </div><!-- .form-group --> 

    <div class="form-group">
        <label for="username">Username</label>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="text" class="form-control" name="username" value="<?php echo $user[ 'username' ]; ?>">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email" value="<?php echo $user[ 'user_email' ]; ?>">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" id="password" class="form-control" name="user_password" value="<?php echo $user[ 'user_password' ]; ?>">
        <label for="show-password">
            <input type="checkbox" id="show-password" />
            Show Password
        </label>
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="about_me">About Me:</label>
        <input type="textarea" class="form-control" id="body" name="about_me" value="<?php echo $user_profile['about_me'] ?>">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="my_education">My Education:</label>
        <input type="textarea" class="form-control" id="body" name="my_education" value="<?php echo $user_profile['my_education'] ?>">
    </div><!-- .form-group -->

    <div class="form-group">
        <label for="my_work">My Work:</label>
        <input type="textarea" class="form-control" id="body" name="my_work" value="<?php echo $user_profile['my_work'] ?>">
    </div><!-- .form-group -->

    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
    </div><!-- .form-group -->
     
</form>

<!--=====================================================================
END CONTENT -->

