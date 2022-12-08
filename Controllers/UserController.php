<?php

namespace Controllers;

require_once('Models/User.php');
use Models\User;

class UserController {

	
	public function __construct() {
		$this->user = new User;
	}


	// /user/create
	public function create() {
		// affiche la vue de creation de categorie
		include('Views/user/create.php');
	}

	// /user/store
	public function store() {
		// on recupere $_POST, on traite les informations			 
		if( 	!empty( $_POST["first_name"] ) && 
			!empty( $_POST["last_name"] ) && 
			!empty( $_POST["email"] ) && 
			!empty( $_POST["password"] ) && 
			!empty( $_POST["confPassword"] ) 		
		){
			$_SESSION['first_name'] =  htmlentities($_POST["first_name"]);
			$_SESSION['last_name'] =  htmlentities($_POST["last_name"]);
			$_SESSION['email'] =  htmlentities($_POST["email"]);
			$password =  htmlentities($_POST["password"]);
			$confPassword =  htmlentities($_POST["confPassword"]);


			$tab=[];
			$tab['first_name'] = $_SESSION['first_name'];
			$tab['last_name'] = $_SESSION['last_name'];
			$tab['email'] = $_SESSION['email'];
			$tab['password'] = $password;

			
			$_SESSION['msgErr'] = "";

			if(empty($_SESSION['first_name'])){
				$_SESSION['msgErr'] .= "Le prenom n'est pas renseigné<br />";
			}
			if(empty($_SESSION['last_name'])){
				$_SESSION['msgErr'] .= "Le nom n'est pas renseigné<br />";
			}

			// Vérifie grâce au filtre PHP que l'email est bien valide
			if(!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)){
				$_SESSION['msgErr'] .= "L'adresse e-mail n'est pas valide<br />";
			 }

		  
			// je vérifie que l'adresse mail n'est pas deja en base : critere UNIQUE sur email dans la BDD
			$_SESSION['msgErr'] .= $this->user->getOneUser($_SESSION['email']) === false ?  "" : "L'adresse e-mail est deja utilisée<br />" ;
		   
		  
			// Validate password strength
			// Je vérifie qu'il y ai bien minuscule, majuscule, chiffre et caractere spécial
			 if( !preg_match("#[0-9]#",$password) ||  !preg_match("#[a-z]#",$password)  ||  !preg_match("#[A-Z]#",$password) ){         
				$_SESSION['msgErr'] .= "Le mot de passe ne respecte pas les conitions ( au moins une majuscule, une minuscule, un chiffre<br />";
			 }
					  
		  
			// Je vérifie que mon mot de passe est supérieur à 8 caractères
			 if(  strlen($password) < 8  ){         
				$_SESSION['msgErr'] .= "Le mot de passe doit faire faire + de 8 carracteres<br />";
			 }
			 		  
		  
			// Je vérifie que les 2 mots de passe sont identique
			if(  $password != $confPassword ){         
				$_SESSION['msgErr'] .= "Les mots de passe ne sont pas identiques<br />";
			}

			// var_dump($_SESSION['msgErr']);

			if(empty($_SESSION['msgErr'])){
				//si pas de message d'erreur

				// on ash le mot de passe
				// $salt = 'pHp_1s_B3sT_l4Ngu4g3';
				$tab['password'] = hash('sha256', $tab['password']);
				// on envois au model pour sauvegarder en base de donnée;
				// var_dump($tab);
				$this->user->insertUser($tab);

				// Une fois fini, on redirige vers la page de l'article
				$_SESSION['msgErr'] = "";
				header("Location: /blog");


			}
			else{
				//si message d'erreur
				header("Location: /user/create");				
			}

			
		}
		else{
			include('Views/user/create.php');
		}
	}
	

	// /user/logout
	public function logout() {	 
		unset($_SESSION['connected']);
		header("Location: /blog");
	}

	// /user/loggin
	public function loggin() {
		include('Views/user/loggin.php');
	}


	// /user/connect
	public function connect() {
		// on recupere $_POST, on traite les informations			 
		if( 	!empty( $_POST["email"] ) && 
			!empty( $_POST["password"] ) 		
		){
			
			$_SESSION['email'] =  htmlentities($_POST["email"]);
			$password =  htmlentities($_POST["password"]);
			

			$tab=[];
			$tab['email'] = $_SESSION['email'];
			$tab['password'] = $password;

			// var_dump($tab);
			$_SESSION['msgErr'] = "";			

			// Vérifie grâce au filtre PHP que l'email est bien valide
			if(!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)){
				$_SESSION['msgErr'] .= "L'adresse e-mail n'est pas valide<br />";
			 }		  
			

			if(empty($_SESSION['msgErr'])){
				//si pas de message d'erreur

				// on ash le mot de passe
				// $salt = 'pHp_1s_B3sT_l4Ngu4g3';
				$tab['password'] = hash('sha256', $tab['password']);

				// on envoie au model pour connection;
				$connectedState = $this->user->connect($tab);

				var_dump($connectedState);

				if(!empty($connectedState)){
					$_SESSION['connected'] = true;
					header("Location: /blog");
				}
				else{
					$_SESSION['msgErr'] .= "parametres de connexion incorrectes !!!<br />";
					header("Location: /user/loggin");	
				}
				


			}
			else{
				//si message d'erreur
				header("Location: /user/loggin");				
			}

			
		}
		else{
			// header("Location: /category/user/create");
			include('Views/user/loggin.php');
		}
	}
	
}