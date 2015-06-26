<?php

	//definir la page sur laquelle on est en train de naviguer en créant 
	//une variable, par défaut la page d'accueil
	$currentPage = "accueil";

	if(empty($_GET["page"]) == false){
		$currentPage = $_GET["page"];
	}

	include "config/config.inc.php";
	include "controllers/".$currentPage."Controller.php";
	include "vues/".$currentPage."Vue.phtml";


