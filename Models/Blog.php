<?php

namespace Models;

use PDO;


class Blog extends Database {


     //fonction qui recupere tous les articles du blog
     public function getAllBlogs() {
		
		$request = $this->bdd->prepare('
			SELECT blogs.*, categories.name AS categorie FROM blogs
               INNER JOIN categories ON categories.id = blogs.category_id
		');

		$request->execute();
		$data = $request->fetchAll(PDO::FETCH_ASSOC);         
		return $data;
	}



     //fonction qui recupere un article via l'id
     public function getOneBlog($id) {
		
		$request = $this->bdd->prepare('
          SELECT blogs.*, categories.name AS categorie FROM blogs
          INNER JOIN categories ON categories.id = blogs.category_id
          WHERE blogs.id= :id
		');

		$request->execute([
               'id' =>  $id 
          ]);

		$data = $request->fetch();         
		return $data;
	}



     //function qui enregistre un article
     public function insertBlog($tab) {
		
		$request = $this->bdd->prepare('
          INSERT INTO blogs (title, author, content, resume, category_id, created_at, updated_at ) 
          VALUES (:title, :author, :content, :resume, :category, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()  )
		');

		$request->execute([
               'title' =>  $tab['title'], 
               'author' =>  $tab['author'], 
               'content' =>  $tab['content'], 
               'resume' =>  $tab['resume'], 
               'category' =>  $tab['categorie']
          ]);
	       
		return $this->bdd->lastInsertId();
	}




     //function qui supprime un article
     public function deleteBlog($id) {

          $request = $this->bdd->prepare('
          DELETE FROM blogs WHERE `blogs`.`id` = :id
          ');

          $request->execute([
               'id' => $id
          ]);	

     }



     //function qui update un article
     public function updateBlog($tab) {
		
		$request = $this->bdd->prepare('
          UPDATE blogs SET
          title = :title, author = :author, content = :content, resume = :resume, 
          category_id = :category, updated_at = CURRENT_TIMESTAMP()
          WHERE id = :id
		');

		$request->execute([
               'id' =>  $tab['id'], 
               'title' =>  $tab['title'], 
               'author' =>  $tab['author'], 
               'content' =>  $tab['content'], 
               'resume' =>  $tab['resume'], 
               'category' =>  $tab['categorie']
          ]);
	       
		return $this->bdd->lastInsertId();
	}


}