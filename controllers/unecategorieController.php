<?php

	//connexion à la base de données (dans le fichier config.inc.php)


	//si pas d'id de page, rediriger vers la homepage
	if(empty($_GET['id']) == true){
		header("Location:index.php");
		die();
	}

	//Récupération de l'id article dans une variable
	$categorieId = $_GET['id'];
	//var_dump($categorieId);
	

	$sql="SELECT * FROM `article` WHERE id_categorie=$categorieId";
	$requete=$connexion->prepare($sql);
	$requete->execute();
	$pageCategorie = $requete->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($pageCategorie);


	$sql="SELECT * FROM `categorie` WHERE id=$categorieId";
	$requete=$connexion->prepare($sql);
	$requete->execute();
	$titreCategorie = $requete->fetch(PDO::FETCH_ASSOC);
	//var_dump($titreCategorie);


	
	//Test sur l'existence d'une catégorie - Redirection vers page 404 si inexistant
	if(array_key_exists('id', $pageCategorie)){		
		echo "Pas d'articles dans cette catégorie";
	}