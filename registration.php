<?php define('TITLE', 'Registration | PHP CMS Project') ?>

<!-- WEB PAGE -->
<?php 
    include "includes/header.php";
    $message = "";
    $isMessage = false;
    $register_id = null;
    

    if( isset( $_POST['submit'] ) ) {
        $username      = $_POST['username'];
        $user_email    = $_POST['email'];
        $user_password = $_POST['password'];

        // CHECK TO MAKE SURE THERE ARE NO EMPTY FIELDS
        if ( !empty($username) && !empty($user_email) && !empty($user_password) ) {

            // CLEAN REGISTRATION VALUE
            $username      = cleanString( $username );
            $user_email    = cleanString( $user_email );
            $user_password = cleanString( $user_password );

            $exists = getUserByUsername( $username );

            if($exists){
                $isMessage = true;
                $message = "Username Already Exists!";
            } else {
                // ENCRYPT PASSWORD
                $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 12) );

                // REGISTER NEW USER
                $register_id = registerUser($username, $user_email, $user_password);

                if(!$register_id){
                    $isMessage = true;
                    $message = "Database Registration Process failed!";
                }
            }

        // IF EMPTY FIELDS GIVE WARNING
        } else {
            $isMessage = true;
            $message = "Fields Cannot Be Empty!";
        }
    } 
?>

<!-- Navigation -->
<?php include "includes/navbar.php" ?>

<!--  CONTENT
----------------------------------------------------------->
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Register</h1>

                    <?php if( isset( $_POST['submit'] ) && $register_id  ) : ?>

                        <h6 class="bg-success text-center"><?php echo $username ?> Has Been Registered!</h6>

                    <?php endif ?>    
                   
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <div class="input-group">
                                <label for="show-password">
                                    <input type="checkbox" id="show-password" />
                                    Show Password
                                </label>
                            </div>
                        </div>

                    <?php if ($isMessage) : ?>

                        <h6 class="bg-danger text-center"><?php echo $message; ?></h6>

                    <?php endif ?>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>
<!----------------------------------------------------------  
--  END CONTENT -->  

<?php include "includes/footer.php" ?>
