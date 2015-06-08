<?php

/**
 *
 * @module          LEPAdoR
 * @author          LEPTON project 
 * @copyright       2010-2015 LEPTON project 
 * @link            http://www.LEPTON-cms.org
 * @license			GNU General Public License
 * @license_terms   please see info.php of this module
 *
 */

// include class.secure.php to protect this file and the whole CMS!
if ( defined( 'LEPTON_PATH' ) )
{
	include( LEPTON_PATH . '/framework/class.secure.php' );
} //defined( 'LEPTON_PATH' )
else
{
	$oneback = "../";
	$root    = $oneback;
	$level   = 1;
	while ( ( $level < 10 ) && ( !file_exists( $root . '/framework/class.secure.php' ) ) )
	{
		$root .= $oneback;
		$level += 1;
	} //( $level < 10 ) && ( !file_exists( $root . '/framework/class.secure.php' ) )
	if ( file_exists( $root . '/framework/class.secure.php' ) )
	{
		include( $root . '/framework/class.secure.php' );
	} //file_exists( $root . '/framework/class.secure.php' )
	else
	{
		trigger_error( sprintf( "[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER[ 'SCRIPT_NAME' ] ), E_USER_ERROR );
	}
}
// end include class.secure.php

$query = "CREATE TABLE `" . TABLE_PREFIX . "mod_lepador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` varchar(255) DEFAULT 'http://www.lepton-cms.com',
  `display` varchar(255) NOT NULL DEFAULT 'all',
  `show_page` int(11) NOT NULL DEFAULT '1',
  `show_snippets` int(11) NOT NULL DEFAULT '1',
  `show_code` int(11) NOT NULL DEFAULT '1',
  `show_tool` int(11) NOT NULL DEFAULT '1',
  `show_core` int(11) NOT NULL DEFAULT '1',
  `show_project` int(11) NOT NULL DEFAULT '0',
  `show_wysiwyg` int(11) NOT NULL DEFAULT '1',
  `show_templates` int(11) NOT NULL DEFAULT '1',
  `show_libs` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
)
";

$database->execute_query( $query );

$fields = array(
	'display' => 'all'
);

$database->build_and_execute(
	'insert',
	TABLE_PREFIX."mod_lepador",
	$fields
);

?>