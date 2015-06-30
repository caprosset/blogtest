<?php

		//Se connecter pour ajouter un article
			if(empty($_SESSION['logged']) == true){
				
				header("Location:index.php?page=connexion");
				die();
			}


			$sql="SELECT * FROM `categorie` WHERE 1 ";
			$requete=$connexion->prepare($sql);
			$requete->execute();
			$categories = $requete->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($categories);


		//$errors
		//var_dump($_POST);
		$errors = [];

		//Tester si $_POST n'est pas vide
		if(empty($_POST) == false){
		
			//Tester si tous les champs ne sont pas vides et ajouter une erreur si oui
			if(empty($_POST['title'])){
				array_push($errors, "Veuillez renseigner un titre");
			}

			if(empty($_POST['description'])){
				array_push($errors, "Veuillez renseigner une description");
			}

			if(empty($_POST['date'])){
				array_push($errors, "Veuillez renseigner une date");
			}

			if(empty($_POST['autor'])){
				array_push($errors, "Veuillez renseigner un auteur");
			}

			if(empty($_FILES['image']) || $_FILES['image']['error'] > 0){
				array_push($errors, "Veuillez uploader une image");
			}else{
				//je définis les extensions que j'accepte
				$extensionsValides = ["jpg", "png", "jpeg"];
				//je stocke dans une variable l'extension de l'image uploadée
				$extensionImage = str_replace("image/", "", $_FILES['image']['type']);
				//j'affiche l'extension de l'image uploadée 
				var_dump($extensionImage);
				//condition: si l'extension de l'image uploadée ne 
				//correspond pas aux extensions que j'accepte, 
				//afficher une erreur
				if(in_array($extensionImage, $extensionsValides) == false){
					array_push($errors, "Veuillez uploader une image valide");
				}
			}

			var_dump($errors);
			var_dump($_POST);
			var_dump($_FILES);

		//Tester si $errors est vide: //Insert into

			if(empty($errors)){
				//donner un id specifique à l'image pour eviter les doublons de noms d'images
				$nomImage = uniqid().".".$extensionImage;

				//enregistrer l'image dans le dossier uploads avant tout
				$resultatUpload = move_uploaded_file($_FILES['image']['tmp_name'], "vues/img/".$nomImage);
				
				//test pour s'assurer qu'on ajoute l'article uniquement si l'upload s'est bien fait:
				if($resultatUpload == true){
				//die('ok');
				//je formule ma requete
				$sql="INSERT INTO `article`(`titre`, `description`, `date_article`, `image`, `auteur`, `id_categorie`) VALUES (:valueTitre, :valueDescription, :valueDate, :valueImage, :valueAuteur, :valueCategory)";

				//pour proteger les donnees que je rentre en SQL
				$requete=$connexion->prepare($sql);

				//equivalences des valeurs à protéger
				$requete-> bindValue(":valueTitre", $_POST['title']);
				$requete-> bindValue(":valueDescription", $_POST['description']);
				$requete-> bindValue(":valueImage", $nomImage);
				$requete-> bindValue(":valueAuteur", $_POST['autor']);
				$requete-> bindValue(":valueDate", $_POST['date']);
				$requete-> bindValue(":valueCategory", $_POST['category']);

				//j'execute ma requete
				$success = $requete->execute();
				}
			}
		
		}