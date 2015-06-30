<?php	

	//FORMULAIRE DE CONNEXION
	session_start();




	//connexion à la base de données

	$dataSource="mysql:host=localhost;dbname=blog;charset=utf8";
	$login="root";
	$mdp="troiswa";
	$connexion= new PDO($dataSource,$login,$mdp);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



	//création de constantes pour garantir l'accès aux différents fichiers 
	//(quelque soit la structure de nos dossiers plus tard)

	//var_dump($_SERVER);
	define("ROOT", str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));
	//echo ROOT;

	define("ROOT_CSS", ROOT."vues/css/");
	//echo ROOT_CSS;

	define("ROOT_JS", ROOT."vues/js/");
	//echo ROOT_JS;

	define("ROOT_IMG", ROOT."vues/img/");
	//echo ROOT_IMG;

	define("ROOT_LIB", ROOT."vues/lib/");
	//echo ROOT_LIB;