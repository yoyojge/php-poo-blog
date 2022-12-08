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
          INSERT INTO users (first_name, last_name, email, password, active  ) 
          VALUES (:first_name, :last_name, :email, :password, 1 )
		');

		$request->execute([
               'first_name' =>  $tab['first_name'],
			'last_name' =>  $tab['last_name'],
			'email' =>  $tab['email'],
			'password' =>  $tab['password']
          ]);
	       
		// return $this->bdd->lastInsertId();
	}


	//function connect
	public function connect($tab) {
		
		$request = $this->bdd->prepare('
          SELECT email FROM  users WHERE email= :email AND password = :password
		');

		$request->execute([
			'email' =>  $tab['email'],
			'password' =>  $tab['password']
          ]);
	     $data = $request->fetch();    
		return $data;
	}




}