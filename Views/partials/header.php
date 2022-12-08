<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="tweet">
	<title>Blog</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
	  <link rel="stylesheet" type="text/css" href="/misc/css/style.css">

    <script src="https://cdn.tiny.cloud/1/o06hdpeotgvt1ks5eg12xfbw4ycd9na36f8cnxsmmnpv5h5z/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

<!-- This example requires Tailwind CSS v2.0+ -->

<?php
$connected=false;
if( isset( $_SESSION['connected'])  && $_SESSION['connected'] === true ){
  $connected=true;
}
?>





<div class="relative bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
      <nav class="hidden md:flex space-x-10">

        <a href="/" class="text-base font-medium text-gray-500 hover:text-gray-900" title="Accueil"> Accueil </a>

        <a href="<?= $connected === false ? '#' : '/blog/create' ?>" class="text-base font-medium text-gray-500 hover:text-gray-900" title="<?= $connected ===false ? 'Vous devez être connecté' : '' ?>"> Nouveau blog </a>

        <a href="/category" class="text-base font-medium text-gray-500 hover:text-gray-900"> Les categories </a>

        <a href="<?= $connected === false ? '#' : '/category/create' ?>" class="text-base font-medium text-gray-500 hover:text-gray-900"   title="<?= $connected === false ? 'Vous devez être connecté' : '' ?>" > Nouvelle categorie </a>

        <?php
        if( $connected === true ){
        ?>  
          <div>
            <a href="/user/logout" class="text-base font-medium text-gray-500 hover:text-gray-900">LOG OUT</a><br >            
        </div>
        <?php
        }else{
        ?>
        <div>
            <a href="/user/create" class="text-base font-medium text-gray-500 hover:text-gray-900">REGISTER</a><br >
            <a href="/user/loggin" class="text-base font-medium text-gray-500 hover:text-gray-900">LOGIN</a>
        </div>
        <?php
        }
        ?>
        

      </nav>
    </div>
  </div>
</div>