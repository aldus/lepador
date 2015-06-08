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

global $lepton_filemanager;
if (!is_object($lepton_filemanager)) require_once( "../../framework/class.lepton.filemanager.php" );


$files_to_register = array(
	'/modules/bookmarks/add_link.php',
	'/modules/bookmarks/add_group.php',
	'/modules/bookmarks/save.php',
	'/modules/bookmarks/save_link.php',
	'/modules/bookmarks/save_group.php',
	'/modules/bookmarks/save_settings.php',
	'/modules/bookmarks/modify_link.php',
	'/modules/bookmarks/modify_group.php',
	'/modules/bookmarks/modify_settings.php',
	'/modules/bookmarks/move_up.php',
	'/modules/bookmarks/move_down.php'
);

$lepton_filemanager->register( $files_to_register );

?>