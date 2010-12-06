<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2009 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

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
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------



$NEEDED_ITEMS=array('reservation','plugin');

define('GLPI_ROOT', '../..');
include (GLPI_ROOT . "/inc/includes.php");

include_once ("inc/plugin_room.class.php");
include_once ("inc/plugin_room.function.php");


if (!isset($_POST['ID'])) exit();

$room=new PluginRoom();
switch ($_POST['glpi_tab'] ){
	case -1 :
		$room->showComputers($_POST['target'],$_POST["ID"]);
		showDeviceReservations($_POST['target'],PLUGIN_ROOM_TYPE,$_POST["ID"]);
		break;
	case 11 :
		showDeviceReservations($_POST['target'],PLUGIN_ROOM_TYPE,$_POST["ID"]);
		break;
	default :
		if ($_POST["ID"]){
			if (!displayPluginAction(PLUGIN_ROOM_TYPE,$_POST["ID"],$_POST['glpi_tab'] )){
				$room->showComputers($_POST['target'],$_POST["ID"]);
			}
		}
		break;
}


?>