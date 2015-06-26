<?php

	$sql="SELECT * FROM `categorie` WHERE 1 ";
	$requete=$connexion->prepare($sql);
	$requete->execute();
	$categories = $requete->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($categories);