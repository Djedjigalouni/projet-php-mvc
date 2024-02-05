<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($data["title"])?$data["title"] : "" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <header class="bg-primary">
        <nav class="navbar navbar-expand container navbar-dark">
            <span class="navbar-brand">
                TP MVC Complet
            </span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= $router->generate("home")  ?>" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $router->generate("login")  ?>" class="nav-link">Connexion</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="<?= $router->generate("admin_article_new")  ?>" class="nav-link">Ajouter article</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $router->generate("admin_user_new")  ?>" class="nav-link">ajouter un user</a>
                </li>
            </ul>
        </nav>
    </header>