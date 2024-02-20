<section class="py-5 mt-5">
    <div class="container border py-3 mt-5 bg-secondary">
        <h1 class="text-center mt-3 my-3"><?= $data["h1"] ?></h1>
        <?php if(!empty($data["erreur"])) :?>
            <div class="alert alert-danger">
        <?php foreach($data["erreur"] as $key => $value) : ?>
            <div><?=  $value  ?></div>
        <?php endforeach ?>
             </div>
    <?php endif ?>
        <div class="row justify-content-center  ">
            <div class="col-8 my-3 bg-light">
                <form method="post">
                <input type="hidden" name="id" class="form-control" id="id" value="<?= $data["vehicule"]->getId() ?>">
                    <div class="form-group mt-3">
                        <label for="nom">nom :*</label>
                        <input type="text" name="nom" class="form-control" id="nom" value="<?= $data["vehicule"]->getNom() ?>">
                     </div>
               
                    <div class="form-group mt-3">
                        <label for="modele">Modele : *</label>
                        <input type="text" name="modele" class="form-control" id="modele" value="<?= $data["vehicule"]->getModele() ?>">
                    </div>
               
                    <div class="form-group mt-3">
                        <label for="contenu">Description :*</label>
                        <textarea name="description" id="description" cols="30" rows="10" ><?= $data["vehicule"]->getDescription() ?></textarea>
                       
                    </div>
                    
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" 
                        id="en_vente" name="en_vente"
                        <?php if ($data["vehicule"]->getEnVente() ==1) { ?> 
                        checked 
                        <?php } ?>
                        >
                        <label class="form-check-label" for="en_vente">
                            Vehicule en vente
                        </label>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="image">Image :*</label>
                        <input type="text" class="form-control" name="image" id="image" value="<?= $data["vehicule"]->getImage() ?> ">
                    </div>
                    
                <div class="text-center mt-4 my-4">
                <?php if (!$data["vehicule"]->getId()) {?>
                    <input type="submit" name="ajouter" class="btn btn-primary" value="Ajouter">
                    <?php }else {?>
                    <input type="submit" name="supprimer" class="btn btn-danger" value="Supprimer">
                    <input type="submit" name="modifier" class="btn btn-primary" value="Modifier">
                    <?php }?>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>