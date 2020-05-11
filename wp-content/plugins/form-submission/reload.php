<?php
  function create_plugin_database_table()
{
    global $wpdb;
    require_once(ABSPATH.'wp-admin/includes/upgrade.php');

    if(count($wpdb->get_var( 'show tables like "$wp_custom_table"' ))==0) 
    {

        $sql = "CREATE TABLE  wp_anicustom_table( 
          firstname varchar(11) NOT NULL ,
          lastname  varchar(128)   NOT NULL
          ) ENGINE=MyISAM DEFAULT CHARSET=latin1" ;

       
  
        dbDelta($sql);
    }
}
 register_activation_hook(__FILE__,'create_plugin_database_table');


?>


<?php
if(isset($_POST['SubmitButton'])){ //check if form was submitted
  $conn = new mysqli('localhost','root','','new-wordpress');
  
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];

  if ($conn->query("INSERT INTO wp_anicustom_table VALUES('$firstname','$lastname')") === TRUE) {
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
plugin name:submission plugin
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
