<?php

	
	
	
	//Si $error est vide => connexion
	
	//var_dump($_POST);

	$error = [];

	//Si $_POST n'est pas vide
	if(empty($_POST) == false){
		
		//Si l'email est vide, ajouter une erreur au tableau $error
		if(empty($_POST['inputEmail'])){
				array_push($error, "Veuillez renseigner votre adresse email");
		//Si le format	de l'email n'est pas valide:
		}else if(filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL) == false){
			array_push($error, "Veuillez renseigner une adresse  valide");
		}

		//Si le mot de passe est vide, ajouter une erreur au tableau $error
		if(empty($_POST['inputPassword'])){
			array_push($error, "Veuillez renseigner votre mot de passe");
		}


		//var_dump($error);

		//s'il n'y a pas d'erreurs, je me connecte
		if(empty($errors)){
			//die('ok');
		
			//je formule ma requête
			$sql="SELECT * FROM `utilisateur` WHERE email= :mail AND password= :mdp";

			//pour proteger les donnees que je rentre en SQL
			$requete=$connexion->prepare($sql);

			//equivalences des valeurs à protéger
			$requete-> bindValue(":mail", $_POST['inputEmail']);
			$requete-> bindValue(":mdp", sha1($_POST['inputPassword']));

			//j'execute ma requete
			$requete->execute();
			$user = $requete->fetch();
			//var_dump($user);
			//die();

			//si infos de connexion, j'ouvre une session et j'atterris sur la HP 
			if(empty($user) == false){
				$_SESSION['logged'] = $user;
				header("Location:index.php");
				die();
			}
		}
	}