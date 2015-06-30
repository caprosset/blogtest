<?php
	//si pas d'id de page, rediriger vers la homepage
	if(empty($_GET['id']) == true){
		header("Location:index.php");
		die();//stoppe l'execution de tout le code suivant
	}

		//1. Récupérer l'id de l'article
		$pageId = $_GET['id'];
		//var_dump($pageId);


		//2. Ajouter à $_COOKIE
		//setcookie("favori", $pageId, strtotime("+1 DAYS"), "/", false, false, true);
		// var_dump($_COOKIE);
		// echo $_COOKIE["favori"];

		if(empty($_COOKIE["favori"]) == true){
	   	$favoris = [];
	   }else{
	   	//visualisons ce aue ça donne en "serialized" et "unserialized":
	   	// var_dump($_COOKIE);
	   	// var_dump($_COOKIE["favori"]);
	   	// var_dump(unserialize($_COOKIE["favori"]));
	   	// die();
	   	$favoris = unserialize($_COOKIE["favori"]);
	   }

	   array_push($favoris, intVal($pageId));
	   setcookie("favori", serialize($favoris), strtotime("+1 DAYS"), "/", false, false, true);
		//3. Redirection sur la page favoris Vue
		header("Location:index.php?page=favoris");
	  	//die();

	  	// visualisons le tableau une fois rempli
	  	var_dump($_COOKIE);
	  	var_dump(unserialize($_COOKIE['favori']));



		//4. Afficher les articles favoris
		//voir favorisController.php où se fait le traitement 

