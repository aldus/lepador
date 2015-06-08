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

$lang = (dirname(__FILE__))."/languages/". LANGUAGE .".php";
require_once ( !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang );

$settings = array();
$database->execute_query(
	"SELECT * FROM `".TABLE_PREFIX."mod_lepador`",
	true,
	$settings,
	false
);

$url = "http://www.lepton-cms.com/modules/lib_lepador/modul_info/get_info.php";
// $url = "http://www.websitebakers.com/modules/lib_lepador/modul_info/get_info.php";

$data_to_post = array(
	'guid'	=> "641458D8-3B96-4328-9146-9CC79C034A1D",
	'rtime'	=> time(),
	'mode'	=> "smart",
	'fields' => 'page_id,modul,type,version,state,license,last_info,author,download'
);

$ch = curl_init() or die("<b>Error:</b> Could not init cURL!");

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, true);

curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_post);

curl_setopt($ch, CURLOPT_URL, $url);	#1

$contents = curl_exec($ch);
if (false === $contents) {
	echo "<b>Error</b>: ".curl_error($ch);
	$failed = true;
} else {
	$failed = false;
}
curl_close($ch);

if (false === $failed) {
	$oXML = simplexml_load_string( $contents );

	$all_modules = array(
		'admin tool' => array(),
		'BE-Theme' => array(),
		'library'	=> array(),
		'page'	=> array(),
		'snippet' => array(),
		'template' => array(),
		'wysiwyg' => array()
	);

	foreach($oXML->modules as $ref) {
		$offset = (string) $ref->type;	
		$all_modules[ $offset ][] = array(
			'name'	=> $ref->modul,
			'version' => $ref->version,
			'state'	=> $ref->state,
			'type'	=> $ref->type,
			'author'	=> $ref->author,
			'license' => $ref->license,
			'last_info'	=> $ref->last_info,
			'download'	=> $ref->download,
			'page_title'	=> $ref->page_title,
			'page_url'	=> $ref->page_url
		);
	}

	/**	*******************************
	 *	Try to get the template-engine.
	 */
	global $parser, $loader;
	if (!isset($parser))
	{
		require_once( LEPTON_PATH."/modules/lib_twig/library.php" );
	}

	$loader->prependPath( dirname(__FILE__)."/templates/", "lepador" );

	$form_values = array(
		'title'	=> "All on LEPAdoR listed modules",
		'all_modules' => $all_modules
	);
	
	echo $parser->render(
		"@lepador/list_2.lte",
		$form_values
	);
}
?>