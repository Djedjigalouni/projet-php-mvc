<section class="py-5 mt-5">
    <div class="container border mt-5 bg-secondary">
        <h1 class="text-center mt-3 my-3"><?= $data["h1"] ?></h1>
        <?php if(!empty($data["erreur"])) :?>
            <div class="alert alert-danger">
            <?php foreach($data["erreur"] as $key => $value) : ?>
                <div><?=  $value  ?></div>
            <?php endforeach ?>
            </div>
        <?php endif ?>
        <div class="row justify-content-center  ">
            <div class="col-8 my-3 bg-light py-4">
                <form method="post">
                    <div class="form-group mt-3 py-4">
                        <label for="email" >Entrez votre email*</label>
                        <input type="email" class="form-control" id="email" placeholder="name@exemple.com" name="email">
                    </div>
               
                    <div class="form-group py-4 mt-3">
                        <label for="password">Entrez votre mot de passe*</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                <!--
                    <div class="form-group py-4 mt-3">
                        <label for="pseudo">Entrez votre pseudo*</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>-->
               
            </div>
            <div class="d-flex justify-content-center my-4 mt-3">
                <input type="submit" class="btn btn-outline-dark" value="connexion">
            </div>
            </form>
        </div>
    </div>
</section>