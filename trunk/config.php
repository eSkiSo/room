<?php
/*
   ----------------------------------------------------------------------
   GLPI - Gestionnaire Libre de Parc Informatique
   Copyright (C) 2003-2008 by the INDEPNET Development Team.

   http://indepnet.net/   http://glpi-addressing.org/
   ----------------------------------------------------------------------

   LICENSE

   This file is part of GLPI.

   GLPI is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   GLPI is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with GLPI; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
   ------------------------------------------------------------------------
 */

// Original Author of file: GRISARD Jean Marc & CAILLAUD Xavier
// Purpose of file:
// ----------------------------------------------------------------------

if(!defined('GLPI_ROOT')){
	define('GLPI_ROOT', '../..'); 
}
include (GLPI_ROOT . "/inc/includes.php");


checkRight("config","w");

	
if (isset($_GET['install'])){
	plugin_room_Install();
	glpi_header($_SERVER["PHP_SELF"]);
} else if (isset($_GET['uninstall'])){
	plugin_room_Uninstall();
	glpi_header($_SERVER["PHP_SELF"]);
}

commonHeader($LANGROOM[0],$_SERVER['PHP_SELF'],"plugins","room");

// Installed 
if(isset($_SESSION["glpiplugin_room_installed"])) {

	echo $LANGROOM[1]."<br><br>";
	echo "<a href=\"javascript:confirmAction('" . addslashes($LANG["common"][55])."','".$_SERVER["PHP_SELF"]."?uninstall=OK')\">Désinstaller</a>";
}else { // Not Installed
	echo $LANGROOM[2]."<br><br>";
	echo "<a href='config.php?install=ok'>Installer</a>";
}

commonFooter();

?>