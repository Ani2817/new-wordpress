<?php
/**
template name:anirudh pandey
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 *
 * 
 * @since Twenty Sixteen 1.0
 */
?>

<?php
ob_start(); //write this line in start of your project, 
//In header file. 

//Here is normal html/css/js/PHP. write your html or echo any things...
// Normal code is here....

//e.g: 
?>
<html>
<body>Hello world <?php date("y"); ?> </body>


$html = ob_get_clean(); //write this line at the end of file.. in footer file
//now your html save in $html variable,


//at the end, 
echo $html;
</html>


