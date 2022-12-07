<?php

namespace Models;

use PDO;

require_once ('Models/Database.php');


class Category extends Database {


     function getCategories(){

          $request = $this->bdd->prepare('
			SELECT * FROM categories
		');

		$request->execute();
		$data = $request->fetchAll(PDO::FETCH_ASSOC);         
		return $data;
     }



	//fonction qui recupere une categorie via l'id
     public function getOneCat($id) {
		
		$request = $this->bdd->prepare('
          SELECT categories.* FROM categories
          WHERE categories.id= :id
		');

		$request->execute([
               'id' =>  $id 
          ]);

		$data = $request->fetch();         
		return $data;
	}



	 //function qui enregistre une categorie
	 public function insertCat($name) {
		
		$request = $this->bdd->prepare('
          INSERT INTO categories (name, created_at, updated_at  ) 
          VALUES (:name, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()  )
		');

		$request->execute([
               'name' =>  $name
          ]);
	       
		return $this->bdd->lastInsertId();
	}


	//function qui supprime une categorie
     public function deleteCat($id) {

          $request = $this->bdd->prepare('
          DELETE FROM categories WHERE `categories`.`id` = :id
          ');

          $request->execute([
               'id' => $id
          ]);	

     }



	 //function qui update une categorie
	 public function updateCat($tab) {
		
		$request = $this->bdd->prepare('
          UPDATE categories SET
          name = :name, updated_at = CURRENT_TIMESTAMP()  
          WHERE id = :id
		');

		$request->execute([
               'id' =>  $tab['id'], 
               'name' =>  $tab['name']
          ]);
	       
		return $this->bdd->lastInsertId();
	}





}