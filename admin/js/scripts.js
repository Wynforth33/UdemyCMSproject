$(document).ready(function(){

  // GOOGLE CHART FUNCTIONALITY 
    var chartData = $('#chart_data').data('chart-data');
    
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable(chartData);

      var options = {
        axisTitlesPosition: 'none',
        chart: {
          title: '',
          subtitle: '',
        }
      };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }

  // SHOW/HIDE PASSWORD FUNCTIONALITY
	  // Gather DOM References
    var password = document.querySelector("#password");
    var toggle   = document.querySelector("#show-password");

    // IF TOGGLE ELEMENT EXISTS ADD FUNCTIONALITY
    if(toggle) {
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
    }

  // CK5 WYSWIG EDITOR
    // GRAB EDITOR ELEMENT IF EXISTS
    var body = document.querySelector( '#body' );

    // IF EDITOR ELEMENT EXISTS TRANSFORM TO WYSIWIG
    if (body) {
    	ClassicEditor
	        .create( document.querySelector( '#body' ) )
	        .then( editor => {
	            console.log( editor );
	        } ).catch( error => {
	            console.error( error );
    	} );
    }

  // SELECT ALL CHECKBOXES FUNCTIONALITY
    // ADDS CLICK LISTENER TO CHECKBOX
    $('#selectAllBoxes').click(function(e){
        // IF CHECKED WILL MAKE ALL .CHECKBOXES CHECKED
        if(this.checked) {
          $('.checkBoxes').each(function(){
             this.checked = true;
          });

        // IF UN-CHECKED WILL MAKE ALL .CHECKBOXES UN-CHECKED
        } else {
          $('.checkBoxes').each(function(){
             this.checked = false;
          });
        }
    })   

  // LOADING SCREEN FUNCITONALITY  
    $('#load-screen').delay(250).fadeOut(600, function(){
      $(this).remove();
    });

});

// DISPLAYS USERS ONLINE IN ADMIN_NAVBAR.PHP
function loadUsersOnline() {
  $.get("../includes/functions.php?onlineusers=result", function(data){

    $(".usersonline").text(data);

  });
}





  


