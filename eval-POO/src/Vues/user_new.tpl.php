<section class="py-5  mt-5">
        
        <div class="container border mt-5 py-5 bg-secondary">
            <h1 class="text-center  my-3"><?= $data["h1"] ?></h1>
            <?php if(!empty($data["erreur"])) :?>
        <div class="alert alert-danger">
            <?php foreach($data["erreur"] as $key => $value) : ?>
                <div><?=  $value  ?></div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
            <div class="row justify-content-center  ">
                <div class="col-8 my-3  bg-light">
                    
            <form method="post">
                <?php if(!empty($data["user"])) :?>
                    <input type="hidden" name="id" id="id" value= "<?= $data["user"]->getId() ?>">
                <?php endif ?>
                <div class="form-group mt-3 ">
                    <label for="email" >Entrez votre email*</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@exemple.com" 
                    <?php if(!empty($data["user"])) :?>
                        value="<?= $data["user"]->getEmail() ?>"
                    <?php endif ?>
                        >
                </div>
            
                <?php if(empty($data["user"])) :?>
                <div class="form-group mt-3">
                    <label for="password">Entrez votre mot de passe*</label>
                    <input type="password" class="form-control" name="password" id="password" >
                </div>
                <?php endif ?>
                <div class="form-group  mt-4 my-4">
                    <label for="pseudo">Entrez votre pseudo*</label>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" 
                    <?php if(!empty($data["user"])) :?>
                        value="<?= $data["user"]->getPseudo() ?>"
                    <?php endif ?>
                        >
                </div>
                <div class="d-flex justify-content-center mt-3 my-3"><button class="btn btn-dark" type="submit">Sauvegarder</button></div>
                </div>
            </div>
</div>
</section>