<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data["title"])?$data["title"] : "" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <span class= "navbar-brand">TP MVC</span>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                        <a class="nav-link <?= $page === "accueil"?"active" : "" ?>" href="/jour4-tp/">Accueil</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link <?= $page === "service"?"active" : "" ?>" href="/jour4-tp/service">Service</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link <?= $page === "connexion"?"active" : "" ?>" href="/jour4-tp/connexion">Connexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
