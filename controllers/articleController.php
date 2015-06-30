<?php

	//connexion à la base de données (dans le fichier config.inc.php)


	//si pas d'id de page, rediriger vers la homepage
	if(empty($_GET['id']) == true){
		header("Location:index.php");
		die();
	}

	//Récupération de l'id article dans une variable
	$pageId = $_GET['id'];
	//var_dump($pageId);

	$sql="SELECT * FROM `article` WHERE id=$pageId";
	$requete=$connexion->prepare($sql);
	$requete->execute();
	$pageArticle = $requete->fetch(PDO::FETCH_ASSOC);
	//var_dump($pageArticle);
	// echo $pageArticle[0]['titre'];

	//Test sur l'existence d'un article - Redirection vers page 404 si inexistant
	if(empty($pageArticle)){
		header($_SERVER["SERVER_PROTOCOL"]." 404 not found");
		include "vues/404.phtml";
		die();
	}
	
	//Insertion d'un commentaire - je fais le traitement après le test sur 
	//l'existence d'un article; car si n'existe pas, ne sert à rien d'insérer
	//un commentaire
		//1. Créer un tableau $errors
		$errors = [];


		
		//2. Si $_POST n'est pas vide:
		if(empty($_POST) == false)
		{
			//var_dump($_POST);
			//-tester si tous les champs ne sont pas vides et la note >=0 et <=5
			if(empty($_POST['autor']))
			{ 
				array_push($errors, "Veuillez renseigner votre nom");
				//die('ok');
			}

			if(empty($_POST['rate']))
			{
				array_push($errors, "Veuillez indiquer une note");	
			}
			else if(empty($_POST['rate']) == false && ($_POST['rate'] < "0" || $_POST["rate"] > "5"))
			{
				array_push($errors, "Veuillez choisir une note valide");
			}

			if(empty($_POST['content'])){ 
				array_push($errors, "Veuillez écrire un commentaire");
			}

			//var_dump($errors);


			//-s'il n'y a pas d'erreurs ($errors est vide): INSERT INTO
			if(empty($errors)){
				//je formule ma requete
				$sql="INSERT INTO `commentaire`(`auteur`, `note`, `contenu`, `date_commentaire`, `id_article`) VALUES (:valueAuteur, :valueNote, :valueContenu, now(), $pageId)";

				//pour proteger les donnees que je rentre en SQL
				$requete=$connexion->prepare($sql);

				//equivalences des valeurs à protéger
				$requete-> bindValue(":valueAuteur", $_POST['autor']);
				$requete-> bindValue(":valueNote", $_POST['rate']);
				$requete-> bindValue(":valueContenu", $_POST['content']);

				//j'execute ma requete
				$success = $requete->execute();
			}
		
		}

		//REQUETE SQL POUR AFFICHER TOUS LES COMMENTAIRES

			$sql = "SELECT * FROM `commentaire` WHERE id_article=$pageId ORDER BY `date_commentaire` DESC";
			$requete=$connexion->prepare($sql);
			$requete->execute();
			$comment = $requete->fetchAll(PDO::FETCH_ASSOC);

