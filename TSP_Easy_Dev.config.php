<?php									
/* @group Easy Dev Package settings, all plugins use the same settings, DO NOT EDIT */
if ( !defined( 'TSP_PARENT_NAME' )) define('TSP_PARENT_NAME', 			'tsp_plugins');
if ( !defined( 'TSP_PARENT_TITLE' )) define('TSP_PARENT_TITLE', 		'TSP Plugins');
if ( !defined( 'TSP_PARENT_MENU_POS' )) define('TSP_PARENT_MENU_POS', 	2617638.180);
/* @end */

/**
* Every plugin that uses Easy Dev must define the DS variable that sets the path deliminter
*
* @var string
*/
if (!defined('DS')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DS', '\\');
    else define('DS', '/');
}//endif

$easy_dev_settings = get_plugin_data( TSP_EASY_DEV_FILE, false, false );
$easy_dev_settings['parent_name']		= TSP_PARENT_NAME;
$easy_dev_settings['parent_title']		= TSP_PARENT_TITLE;
$easy_dev_settings['menu_pos'] 			= TSP_PARENT_MENU_POS;

$easy_dev_settings['name'] 				= TSP_EASY_DEV_NAME;
$easy_dev_settings['title'] 			= TSP_EASY_DEV_TITLE;
$easy_dev_settings['file']	 			= TSP_EASY_DEV_FILE;
$easy_dev_settings['base_name']	 		= TSP_EASY_DEV_BASE_NAME;

$easy_dev_settings['smarty_template_dirs']	= array( TSP_EASY_DEV_ASSETS_TEMPLATES_PATH );
$easy_dev_settings['smarty_compiled_dir']  	= TSP_EASY_DEV_TMP_PATH . TSP_EASY_DEV_NAME . DS . 'compiled';
$easy_dev_settings['smarty_cache_dir'] 		= TSP_EASY_DEV_TMP_PATH . TSP_EASY_DEV_NAME . DS . 'cache';

//* Custom globals *//
$easy_dev_settings['contact_url'] 			= 'http://www.thesoftwarepeople.com/about-us/contact-us.html';
$easy_dev_settings['plugin_list']			= 'http://www.thesoftwarepeople.com/plugins/wordpress/plugins.json';
//* Custom globals *//

$easy_dev_settings['plugin_options']	= array(
	'category_fields'			=> array(),
	'post_fields'				=> array(),
	'widget_fields'				=> array(),
	'settings_fields'			=> array(),
	'shortcode_fields'			=> array(),
);

//--------------------------------------------------------
// Register classes
//--------------------------------------------------------
//set_include_path( TSP_EASY_DEV_CLASS_PATH );
//spl_autoload_extensions( '.class.php' ); 
//spl_autoload_register();
 
spl_autoload_register( 'register_classes' );

/**
 * Hook implementation for spl_autoload_register
 *
 * @ignore
 *
 * @since 1.0
 *
 * @param string $class Required - the class name to include the class file for
 *
 * @return none
 */
function register_classes( $class )
{
    if (file_exists( TSP_EASY_DEV_CLASS_PATH . $class . '.class.php' ))
    {
    	include_once TSP_EASY_DEV_CLASS_PATH . $class . '.class.php';
    	
    	if (file_exists( TSP_EASY_DEV_INCLUDES_PATH . $class . '.funcs.php' ))
    	{
    		include_once TSP_EASY_DEV_INCLUDES_PATH . $class . '.funcs.php';
    	}//end if
    }//end if
    
    if ( $class == 'Smarty' )
    {
	    if (file_exists( TSP_EASY_DEV_LIB_PATH . $class . DS . $class. '.class.php' ))
	    {
	        include_once TSP_EASY_DEV_LIB_PATH . $class . DS . $class. '.class.php';
	    }//end if
    }//end if
}//end register_classes
?>