<?php

namespace Models;

use PDO;


class User extends Database {
     
	//fonction qui recupere un user via l'email
     public function getOneUser($email) {
		
		$request = $this->bdd->prepare('
          SELECT * FROM users
          WHERE email= :email
		');

		$request->execute([
               'email' =>  $email 
          ]);

		$data = $request->fetch();         
		return $data;
	}



	 //function qui enregistre un user
	 public function insertUser($tab) {
		
		$request = $this->bdd->prepare('
          INSERT INTO users (first_name, last_name, email, password, active, token  ) 
          VALUES (:first_name, :last_name, :email, :password, 0, :token )
		');

		return $request->execute([
               'first_name' =>  $tab['first_name'],
			'last_name' =>  $tab['last_name'],
			'email' =>  $tab['email'],
			'password' =>  $tab['password'],
			'token' =>  $tab['token']
          ]);
	       
		// return $this->bdd->lastInsertId();
	}


	//function connect
	public function connect($tab) {
		
		$request = $this->bdd->prepare('
          SELECT first_name, password, active FROM  users WHERE email= :email  
		');

		$request->execute([
			'email' =>  $tab['email']
			
          ]);
		$data = $request->fetch(PDO::FETCH_ASSOC);   
		return $data;
	}


	//function validByToken
	public function validByToken($token) {
		
		$request = $this->bdd->prepare('
		UPDATE users SET token = "", active = 1  WHERE token = :token
		');

		$request->execute([
			'token' =>  $token
          ]);
	     // $data = $request->fetch();    
		// return $data;
	}




}