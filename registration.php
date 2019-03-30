<?php define('TITLE', 'Registration | PHP CMS Project') ?>

<!-- WEB PAGE -->
<?php 
    include "includes/header.php";
    $message = "";
    $isMessage = false;

    if( isset( $_POST['submit'] ) ) {
        $username      = $_POST['username'];
        $user_email    = $_POST['username'];
        $user_password = $_POST['password'];

        // CHECK TO MAKE SURE THERE ARE NO EMPTY FIELDS
        if ( !empty($username) && !empty($user_email) && !empty($user_password) ) {

            // CLEAN REGISTRATION VALUE
            $username      = cleanString( $username );
            $user_email    = cleanString( $user_email );
            $user_password = cleanString( $user_password );

            // ENCRYPT PASSWORD
            $crypted_password = encryptPassword( $user_password, COST_PARAM, SALT1 );

            // REGISTER NEW USER
            $user_id = registerUser($username, $user_email, $crypted_password);

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
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
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
