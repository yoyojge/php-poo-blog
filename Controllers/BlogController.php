<?php

namespace Controllers;


require_once('Models/Blog.php');
use Models\Blog;

require_once('Models/Category.php');
use Models\Category;

class BlogController {	

	/**
	 * /blog
	 * /blog/index
	 * /
	 */
	public function index() {
		// Ici on recupere tout les articles de blog
		//appel de fonction de model
		$blog = new Blog;
		$blogs = $blog->getAllBlogs();
		include('Views/blog/index.php');
	}

	// /blog/show/1
	public function show($id) {
		// Ici on affiche le contenu d'un article
		$blog = new Blog;
		$article = $blog->getOneBlog($id);
		include('Views/blog/show.php');
	}

	// /blog/create
	public function create() {
		// affiche la vue de creation de blog
		$cat = new Category;
		$categories = $cat->getCategories();
		include('Views/blog/create.php');
	}

	// /blog/store
	public function store() {
		// on recupere $_POST, on traite les informations			 
		if( !empty( $_POST["title"] ) && !empty( $_POST["content"] ) && !empty( $_POST["categorie"]) && !empty( $_POST["author"]) && !empty( $_POST["resume"]) ){
			$title =  htmlentities($_POST["title"]);
			$content =  htmlentities($_POST["content"]);
			$categorie =  htmlentities($_POST["categorie"]);
			$resume =  htmlentities($_POST["resume"]);
			$author =  htmlentities($_POST["author"]);
			$tab=[];
			$tab['title'] = $title;
			$tab['content'] = $content;
			$tab['categorie'] = $categorie;
			$tab['resume'] = $resume;
			$tab['author'] = $author;
			
			// on envois au model pour sauvegarder en base de donnée;
			$blog = new Blog;
			$stored = $blog->insertBlog($tab);
			
			// Une fois fini, on redirige vers la page de l'article
			header("Location: /blog/show/".$stored);
			
		}
		
	}

	// /blog/edit/1
	public function edit($id) {
		// affiche la vue de creation de blog
		// Vous devez donc recupérer la liste des categories egalement
		$cat = new Category;
		$categories = $cat->getCategories();

		$blog = new Blog;
		$article = $blog->getOneBlog($id);

		// Afficher la vue d'edition du blog
		include('Views/blog/edit.php');
	}

	// /blog/update/:id
	public function update() {
		// on recupere $_POST, on traite les informations, et on envois au model pour mettre a jour en base de donnée;

		if( !empty( $_POST["title"] ) && !empty( $_POST["content"] ) && !empty( $_POST["categorie"]) && !empty( $_POST["author"]) && !empty( $_POST["resume"]) && !empty( $_POST["id"]) ){
			$title =  htmlentities($_POST["title"]);
			$content =  htmlentities($_POST["content"]);
			$categorie =  htmlentities($_POST["categorie"]);
			$resume =  htmlentities($_POST["resume"]);
			$author =  htmlentities($_POST["author"]);
			$id =  htmlentities($_POST["id"]);

			$tab=[];
			$tab['id'] = $id;
			$tab['title'] = $title;
			$tab['content'] = $content;
			$tab['categorie'] = $categorie;
			$tab['resume'] = $resume;
			$tab['author'] = $author;
			
			// on envois au model pour sauvegarder en base de donnée;
			$blog = new Blog;
			$blog->updateBlog($tab);

			// Une fois fini, on redirige vers la page de l'article
			header("Location: /blog/show/".$id);
			
		}
		
	}

	// /blog/delete/1
	public function delete($id) {
		// On demande au model de supprimer l'article correspondant a l'id
		$id =  htmlentities($id);

		$blog = new Blog;
		$blog->deleteBlog($id);
		// on redirige vers la page d'accueil
		header("Location: /blog/");
	}
}