<div class="container">
    <img src="../images/<?php echo $user[ 'user_image' ]; ?>">
    
    <h2><?php echo $user[ 'username' ]; ?></h2>
    
    <h3>Role: <?php echo $user[ 'user_role' ]; ?></h3>
    <h4>Name: <?php echo $user[ 'user_firstname' ]; ?> <?php echo $user[ 'user_lastname' ]; ?> </h4>
    <h4>Email: <?php echo $user[ 'user_email' ]; ?>

    <h4>About Me:</h4>
    <p><?php echo $user_profile['about_me']; ?></p>

    <h4>My Education:</h4>
    <p><?php echo $user_profile['my_education']; ?></p>

    <h4>My Work:</h4>
    <p><?php echo $user_profile['my_work']; ?></p>

    <div class="form-group">
        <a href='admin_profile.php?source=edit_profile&<?php echo $logged_in; ?>' class="btn btn-primary">Edit Profile</a>
    </div><!-- .form-group -->
</div>

