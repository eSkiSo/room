<?php
/*
 * @version $Id: room.form.php 37 2009-01-06 18:41:29Z moyo $
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

// Ce fichier sert à ouvrir le formulaire de l'objet Salle
$NEEDED_ITEMS=array('reservation','plugin');

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT . "/inc/includes.php");

if(!isset($_GET["id"])) $_GET["id"] = "-1";

if (!isset($_GET["withtemplate"])) $_GET["withtemplate"] = "";


$room=new PluginRoomRoom();

if (isset($_POST["add"])){ // Ajout d'une salle

	$room->check(-1,'w',$_POST);

	$newID=$room->add($_POST);
	echo "Ajout de la salle";
	glpi_header($_SERVER['HTTP_REFERER']);

} else if (isset($_POST["delete"])) { // Supression d'une salle
	$room->check($_POST["id"],'w');

	$room->delete($_POST);
	glpi_header($CFG_GLPI["root_doc"]."/plugins/room/index.php");

} else if (isset($_POST["purge"])) { // Purge de la salle
	$room->check($_POST["id"],'w');

	$room->delete($_POST,1);
	glpi_header($CFG_GLPI["root_doc"]."/plugins/room/index.php");

} else if (isset($_POST["restore"])) { // Restauration de la salle
	$room->check($_POST["id"],'w');

	$room->restore($_POST);
	glpi_header($CFG_GLPI["root_doc"]."/plugins/room/index.php");

} else if (isset($_POST["update"])) { // Modification d'une salle
	$room->check($_POST["id"],'w');

	$room->update($_POST);
	glpi_header($_SERVER['HTTP_REFERER']);

} else if (isset($_POST["additem"])){ // Ajout de la liaison à un ordinateur

	$room->check($_POST["room_id"],'w');  // Ça devrait pas être rooms_id?

	if ($_POST['room_id']>0&&$_POST['computers_id']>0) {
		$room->plugin_room_AddDevice($_POST["room_id"],$_POST["computers_id"]);
	}
	glpi_header($_SERVER['HTTP_REFERER']);

} else if (isset($_POST["deleteitem"])){ // Suppression de la liaison à un ordinateur

	$room->check($_POST["room_id"],'w');

	if (count($_POST["item"])){
		foreach ($_POST["item"] as $key => $val){
			$room->plugin_room_DeleteDevice($key);
		}
	}
	glpi_header($_SERVER['HTTP_REFERER']);

} else { // Logiquement on passe ici pour visualiser une salle
	$room->check($_GET["id"],'r');

	// test l'onglet de départ a afficher à l'ouverture de la fiche
	if (!isset($_SESSION['glpi_tab'])) $_SESSION['glpi_tab']=1;
	if (isset($_GET['tab'])) {
		$_SESSION['glpi_tab']=$_GET['tab'];
	}

	commonHeader($LANG['plugin_room'][0],"plugins","room");

	$room->showForm($_GET["id"]);

	commonFooter();
}
?>