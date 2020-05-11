<?php
/**
 * WordPress Upgrade Functions. Old file, must not be used. Include
 * wp-admin/includes/upgrade.php instead.
 *
 * @deprecated 2.5.0
 * @package WordPress
 * @subpackage Administration
 */

_deprecated_file( basename( __FILE__ ), '2.5.0', 'wp-admin/includes/upgrade.php' );
require_once ABSPATH . 'wp-admin/includes/upgrade.php';



function create_plugin_database_table()
{
    global $table_prefix, $wpdb;

    $tblname = 'pin';
    $wp_track_table = $table_prefix . "$tblname ";

    #Check to see if the table exists already, if not, then create it

    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
    {

        $sql = "CREATE TABLE `". $wp_track_table . "` ( ";
        $sql .= "  `id`  int(11)   NOT NULL auto_increment, ";
        $sql .= "  `pincode`  int(128)   NOT NULL, ";
        $sql .= "  PRIMARY KEY `order_id` (`id`) "; 
        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }
}

 register_activation_hook( __FILE__, 'create_plugin_database_table' );