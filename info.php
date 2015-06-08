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

$module_directory	= 'lepador';
$module_name		= 'LEPAdoR';
$module_function	= 'tool';
$module_version		= '0.1.1';
$module_platform	= '2.0.0';
$module_delete		=  true;
$module_author		= 'LEPTON project';
$module_license     = 'GNU General Public License';
$module_description	= 'Get information about modules listed on LEPAdoR, the LEPTON Addons Repository.';
$module_home		= 'http://www.lepton-cms.com/';
$module_guid		= "2EE0A280-55BC-4118-9150-77CC39481FBA";

?>