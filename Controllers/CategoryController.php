<?php

namespace Controllers;

require_once('Models/Category.php');
use Models\Category;

class CategoryController {

	/**
	 * /category
	 * /category/index
	 */
	public function index() {
		$cat = new Category;
		$categories = $cat->getCategories();
		// var_dump($blogs);
		include('Views/category/index.php');

	}

	// /category/show/1
	public function show($id) {
		// Ici on affiche le contenu d'une categorie
		$cat = new Category;
		$categorie = $cat->getOneCat($id);
		// var_dump($categorie);
		include('Views/category/show.php');
	}

	// /category/create
	public function create() {
		// affiche la vue de creation de categorie
		include('Views/category/create.php');
	}

	// /category/store
	public function store() {
		// on recupere $_POST, on traite les informations			 
		if( !empty( $_POST["name"] )  ){
			$name =  htmlentities($_POST["name"]);
			
			// on envois au model pour sauvegarder en base de donnée;
			$cat = new Category;
			$stored = $cat->insertCat($name);

			// Une fois fini, on redirige vers la page de l'article
			header("Location: /category/show/".$stored);
			
		}
	}

	// /category/edit/1
	public function edit($id) {
		// affiche la vue de creation de blog
		$cat = new Category;
		$categorie = $cat->getOneCat($id);
		// Afficher la vue d'edition du blog
		include('Views/category/edit.php');
	}

	// /category/update/:id
	public function update() {
		if( !empty( $_POST["id"] ) && !empty( $_POST["name"] ) ){
			$name =  htmlentities($_POST["name"]);
			$id =  htmlentities($_POST["id"]);

			$tab=[];
			$tab['id'] = $id;
			$tab['name'] = $name;			
			
			// on envois au model pour sauvegarder en base de donnée;
			$cat = new Category;
			$cat->updateCat($tab);

			// Une fois fini, on redirige vers la page de l'article
			header("Location: /category/show/".$id);
			
		}



	}

	// /category/delete/1
	public function delete($id) {
		// On demande au model de supprimer la categorie correspondant a l'id
		$id =  htmlentities($id);
		$cat = new Category;
		$cat->deleteCat($id);

		// on redirige vers la page d'accueil
		header("Location: /category/");
	}
}