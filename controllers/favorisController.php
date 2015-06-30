<?php

	//pour supprimer tous les favoris (cf. bouton "supprimer les favoris")
		if(empty($_GET["supprimer"]) == false){
			setcookie("favori", null, -1, "/");
			header("Location:index.php?page=favoris");
			die();
		}


		$pageFavori = [];
		
		if(empty($_COOKIE['favori']) == false){
			// var_dump($_COOKIE);
			// var_dump($_COOKIE['favori']);
			// var_dump(unserialize($_COOKIE['favori']));

			$favoris = unserialize($_COOKIE["favori"]);
			$idFavoris = implode(",", $favoris);
			
			//var_dump($idFavoris);

	 		$sql="SELECT * FROM `article` WHERE id IN($idFavoris)";
			$requete=$connexion->prepare($sql);
			$requete -> bindValue(":idArticle", $_COOKIE['favori']);
			$requete->execute();
			$pageFavori = $requete->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($pageFavori);
		}	
