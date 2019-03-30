<?php 
    $user_id = 0;
    $user    = null;
    
    if(isset($_GET['user_id'] )){
        $user_id = $_GET['user_id'];
        $user = getUser($user_id);
    }

    $user_role = $user[ 'user_role' ];
?>

<!-- CONTENT 
======================================================================-->
<h2>Edit User</h2>
  
<form action="admin_users.php" method="Post" enctype="multipart/form-data">
    
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
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php if ($user_role === 'admin' ) : ?>
              
              <option value="subscriber">subscriber</option>
              <option value="test user">test user</option>

            <?php elseif ( $user_role === 'subscriber' ) : ?>

              <option value="admin">admin</option>
              <option value="test user">test user</option>

            <?php else : ?>

              <option value="admin">admin</option>
              <option value="subscriber">subscriber</option>  

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
        <label for="user_password">Change Password</label>
        <input type="password" id="password" class="form-control" name="user_password" value="<?php echo $user[ 'user_password' ]; ?>">
        <label for="show-password">
            <input type="checkbox" id="show-password" />
            Show Password
        </label>
    
    </div><!-- .form-group -->
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div><!-- .form-group -->
     
</form>

<!--=====================================================================
END CONTENT -->

