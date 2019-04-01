<div class="well">
        <?php if ( isset($_GET['user'] ) ) : ?>

            <div class="container">
                <h4>Welcome - <?php echo $user_name ?></h4>
                <h5>Role: <?php echo $user_role ?></h5>
                <form action="includes/logout.php" method="post">
                    <div class="input-group">               
                        <span class="input-group-btn">
                            <button name="logout" class="btn btn-primary" type="submit">Logout!</button>
                        </span>  
                    </div><!-- .input-group -->
                </form> 
            </div>

        <?php else : ?>  
         
            <h4>Login</h4>
            
            <?php 
                if( isset( $_GET['fail'] ) ) {
                    switch ( $_GET['fail'] ) {
                        case '1';
                        echo "USERNAME DOES NOT EXIST!";
                        break;

                        case '2';
                        echo "PASSWORD IS NOT CORRECT";
                        break;
                    }
                }
            ?>

            <form action="includes/login.php" method="post">     
                <div class="form-group">             
                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div><!-- .input-group -->  
                <div class="input-group">               
                    <input name="password" type="password" id="password" class="form-control" placeholder="Enter Password">

                    <span class="input-group-btn">
                        <button name="login" class="btn btn-primary" type="submit">Login</button>
                    </span> 
                    <span class="input-group-btn">
                        <a role="button" class="btn btn-success" href="registration.php">Sign Up</a>
                    </span> 
                </div><!-- .input-group --> 
                <div class="input-group">
                    <label for="show-password">
                        <input type="checkbox" id="show-password" />
                        Show Password
                    </label>
                </div>
            </form>

         <?php endif; ?>   

    </div><!-- .well -->