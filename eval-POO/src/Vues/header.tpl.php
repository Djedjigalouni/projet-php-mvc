<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= isset($data["title"])?$data["title"] : "" ?></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- Font Awesome -->
   <script src="https://kit.fontawesome.com/14273d579a.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="style1.css">
   </head>
   <body>
   <header>
      <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-secondary">
        <div class="container-fluid ">
          <img src="images/logo.jpg" alt="logo" style = "height: 70px ; width :70px; margin-right:2px">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item ">
              <a class="nav-link text-dark fw-bolder <?= $template === "home"?"active" : "" ?>" aria-current="page" href="<?= $router->generate("home")  ?>">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark fw-bolder <?= $template === "mention_legale"?"active" : "" ?>" aria-current="page" href="<?= $router->generate("mention_legale")  ?>">Mention legale</a>
            </li>
          </ul>
          <?php if(!isset($_SESSION["user"])) : ?>
            <a class="btn btn-outline-success me-2 text-dark fw-bolder" href="<?= $router->generate("admin_user_new")  ?>?access=public" role="button" >Inscrivez vous maintenant</a>
            <a class="btn btn-outline-success me-2 text-dark fw-bolder" href="<?= $router->generate("login")  ?>" role="button" >Se connecter</a>
          <?php endif ?>
           <?php if(isset($_SESSION["user"])) : ?> 
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link text-dark fw-bolder active" aria-current="page" href="#">Bienvenu <?= $_SESSION["Pseudo"] ?></a>
            </li>
                <li class="nav-item dropdown ">
                    <a href="#" class="nav-link dropdown-toggle text-dark fw-bolder" data-bs-toggle="dropdown" role="button">
                       espace gestion
                    </a>
                    <ul class="dropdown-menu">
                    <li><a href="<?= $router->generate("users")  ?>" class="dropdown-item">Gérer les utilisateurs</a></li>
                        <li><a href="<?= $router->generate("admin_user_new")  ?>" class="dropdown-item">Ajouter un profil</a></li>
                        <li><a href="<?= $router->generate("admin_vehicule_new")  ?>" class="dropdown-item">Ajouter vehicule</a></li>
                        <li class="nav-item">
                    <a href="<?= $router->generate("logout")  ?>" class="nav-link text-dark">Déconnexion</a>
                </li>
                    </ul>
                </li>
            </ul>
            <?php endif ?>
          
        </div>
      </div>
    </nav>
  </header>