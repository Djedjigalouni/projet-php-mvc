<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&display=swap" rel="stylesheet">

    <style>
        :root{
            /* variable css 
            https://developer.mozilla.org/fr/docs/Web/CSS/Using_CSS_custom_properties
            https://caniuse.com/css-variables
            */ 
            --bs-font-sans-serif : "Protest Riot", sans-serif;
            --bs-heading-color : pink ; 
        }


    </style>

  </head>
  <body>
    <header class="bg-warning">
        <nav class="navbar navbar-expand container navbar-dark">
            <span class="navbar-brand">
                TP MVC Complet
            </span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= $router->generate("home")  ?>" class="nav-link">Accueil</a>
                </li>
                <?php if(!isset($_SESSION["user"])) : ?>
                <li class="nav-item">
                    <a href="<?= $router->generate("login")  ?>" class="nav-link">Connexion</a>
                </li>
                <?php endif ?>
            </ul>
            <?php if(isset($_SESSION["user"])) : ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="<?= $router->generate("admin_article_new")  ?>" class="nav-link">Ajouter article</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $router->generate("admin_user_new")  ?>" class="nav-link">Ajouter gestionnaire</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $router->generate("logout")  ?>" class="nav-link">Déconnexion</a>
                </li>
            </ul>
            <?php endif ?>
        </nav>
    </header>