<?php

namespace Controllers;

require_once('Models/User.php');
use Models\User;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Somnambulist\Components\Validation\Factory;

class UserController {

	
	public function __construct() {
		$this->user = new User;
	}


	public function hashPassWord($psw){
		return password_hash($psw, PASSWORD_ARGON2I);
	}

	public function verifyThePassword($pswClear, $pswHashed){
		return password_verify($pswClear, $pswHashed); 
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


			$tab=[];
			$tab['first_name'] = $_SESSION['first_name'];
			$tab['last_name'] = $_SESSION['last_name'];
			$tab['email'] = $_SESSION['email'];
			$tab['password'] = $password;
 
			$tab['token'] = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
			
			$_SESSION['msgErr'] = "";
			
			$validator = new Factory();
			$validation = $validator->make($_POST + $_FILES, [
				'first_name'                  => 'required',
				'last_name'                  => 'required',
				'email'                 => 'required|email',
				'password'              => 'required|min:8',
				'confPassword'      => 'required|same:password'
			 ]);

			//  $validation->messages()->default('fr');
			//  $validation->messages()->add('en', 'password:min', 'oulala il faut + de carracteres...');

			 $validation->validate();
			 
			 if ($validation->fails()) {
				// handling errors
				$errors = $validation->errors();				
				$_SESSION['msgErr'] .= implode(" ", $errors->all('<li>:message</li>') );
			 } 
		   
		  
		
			// Validate password strength : Je vérifie qu'il y ai bien minuscule, majuscule, chiffre et caractere spécial
			//  if( !preg_match("#[0-9]#",$password) ||  !preg_match("#[a-z]#",$password)  ||  !preg_match("#[A-Z]#",$password) ){         
			// 	$_SESSION['msgErr'] .= "Le mot de passe ne respecte pas les conitions ( au moins une majuscule, une minuscule, un chiffre<br />";
			//  }
					  
		  
			
			 		  
		  
			

			// var_dump($_SESSION['msgErr']);

			if(empty($_SESSION['msgErr'])){
				//si pas de message d'erreur

				// on hashPassWord le mot de passe				
				$tab['password'] = $this->hashPassWord($tab['password']);

				// on envois au model pour sauvegarder en base de donnée;
				$enregistrement =  $this->user->insertUser($tab);

				
				//envoi du mail avec le lien avec le jeton
				if($enregistrement === true){

					$mail = new PHPMailer();

					// $mail->SMTPDebug = 2;                   			// Enable verbose debug output
					$mail->isSMTP();                        			// Set mailer to use SMTP
					$mail->Host       = 'smtp.gmail.com;';    			// Specify main SMTP server
					$mail->SMTPAuth   = true;               			// Enable SMTP authentication
					include('gitIgnore/gmailApp.php');
					$mail->SMTPSecure = 'tls';              			// Enable TLS encryption, 'ssl' also accepted
					$mail->Port       = 587;                			// TCP port to connect to

					$mail->setFrom('johann.griffe.pro@gmail.com', 'johann');           	// Set sender of the mail
					       	// Add a recipient
					$mail->addAddress($tab['email'], $tab['first_name']);   	// Name is optional

					$mail->isHTML(true);                                  
					$mail->Subject = 'Subject';
					$mail->Body    = 'HTML message body in <b>bold</b>!<br /> <a href="http://blog/?token='.$tab["token"].'" target="_blank">click that</a>';
					$mail->AltBody = 'Body in plain text for non-HTML mail clients';

					$mail->send();
					
					// Une fois fini, on redirige vers la page de l'article
					$_SESSION['msgErr'] = "Veuillez confirmer votre inscription en cliquant dans l'email";
					header("Location: /blog");
					return;
				}
				else{
					$_SESSION['msgErr'] = "Il y a eu un probleme lors de votre inscription";
					header("Location: /user/create");
					return;
				}
				


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

				
				// var_dump($tab['password']);die;
				// on recupere le mot de passe hashé qui est en BDD
				$infoConnect = $this->user->connect($tab);

				//on verifie que le mot de passe hashé est valide
				// var_dump($infoConnect); 
				// echo $tab['password']; die;
				// echo $infoConnect['password']; die;

				if( $this->verifyThePassword( $tab['password'], $infoConnect['password'] )   && $infoConnect['active'] ){
					$_SESSION['user']['connected'] = true;
					$_SESSION['user']['first_name'] = $infoConnect['first_name'];
					header("Location: /blog");
				}
				elseif($infoConnect['active'] == 0){
					$_SESSION['msgErr'] .= "Vous n'avez pas validé votre compte, regardez vos emails !!!<br />";
					header("Location: /user/loggin");	
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