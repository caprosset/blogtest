<?php

//STOCKER DANS UNE SESSION
	//session_start();
	//$_SESSION['test'] = "3wa";
	//var_dump($_SESSION);
	//die;


//STOCKER DANS LES COOKIES
	//setcookie("test", "3wa", strtotime("+1 DAYS"), "/", false, false, true);
	//var_dump($_COOKIE);
	//die();
	//echo $_COOKIE["test"];
	

	//unset($_COOKIE['favori']); //supprime le cookie
	//setcookie("favori", null, -1, "/"); //pour éviter qu'il revienne


	//definir la page sur laquelle on est en train de naviguer en créant 
	//une variable, par défaut la page d'accueil
	$currentPage = "accueil";

	if(empty($_GET["page"]) == false){
		$currentPage = $_GET["page"];
	}

	
	include "config/config.inc.php";

	//on stocke ces chemins dans une variable et on ne les inclut que si on passe le test 
	//(pages se chargent correctement)
	$controller =  "controllers/".$currentPage."Controller.php";
	$vue = "vues/".$currentPage."Vue.phtml";

	//test: si ces pages n'existent pas, on charge une page d'erreur:
	if(file_exists($controller) == false || file_exists($vue) == false){
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		include "vues/404.phtml";
		die();
	}
	include $controller; 
	include $vue;





