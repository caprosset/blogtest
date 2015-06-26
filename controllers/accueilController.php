<?php
	//1. connexion à la base de données (dans le fichier config.inc.php)


	//2. faire la requête permettant de récupérer tous les articles 
	//prepare, execute, fetchAll

	$sql="SELECT * FROM `article` WHERE 1";
	$requete=$connexion->prepare($sql);
	$requete->execute();
	$article = $requete->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($article);


	//3. afficher les articles sur accueilVue.phtml
	//voir php dans accueilVue.phtml

