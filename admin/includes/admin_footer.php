    </div><!-- #wrapper -->

<!--SCRIPTS 
====================================================-->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<script>
		// Gather DOM References
        var password = document.querySelector("#password");
        var toggle   = document.querySelector("#show-password");

        // NOTE: the "(input)" event doesn't work on checkboxes in Safari or IE. As such, 
        // we use the "(click)" event to make this work cross-browser.
        toggle.addEventListener("click", handleToggleClick, false);

        // We handle the toggle click, changing the TYPE of password input. 
        function handleToggleClick(e) {
            if ( this.checked ) {
                console.warn( "Change input 'type' to: Text");
                password.type = "text";
            } else {
                console.warn( "Change input 'type' to: Password");
                password.type = "password";
            }
        }
	</script>
  </body>

</html>