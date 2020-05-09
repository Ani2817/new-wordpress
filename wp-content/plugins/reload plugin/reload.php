<?php
if(isset($_POST['SubmitButton'])){ //check if form was submitted
  $conn = new mysqli('localhost','root','','test1');
  
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];

  if ($conn->query("INSERT INTO test1 VALUES('$firstname','$lastname')") === TRUE) {
  echo "successfully inserted";
	} 
	else {
	  echo "insertion failed" ;
	}

	$conn->close();
}    
?>

<?php      
/*
plugin name:reload plugin
description:this is a simple plugin for purpose of learning
version:1.0.0
author:Anirudh pandey

*/


add_shortcode( 'add_fields', 'input_fields' );


function input_fields( $atts ) {
    
    ?>
    <form id="myForm" action="" method = "post">
        <input type="text" name="firstname" placeholder="firstname"><br>

        <input type="text" name="lastname" placeholder="lastname"><br>
 
        <button id='#sub' type='submit' name='SubmitButton'> submit</button>
    </form>
    <span id="result"></span>
   <?php
}
?>
<script src="my_script.js" type="text/javascript"></script>
