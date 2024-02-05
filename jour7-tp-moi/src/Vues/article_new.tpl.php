<div class="container">
    <h1><?= $data["h1"] ?></h1>
    <?php if(!empty($data["erreur"])) :?>
        <div class="alert alert-danger">
            <?php foreach($data["erreur"] as $key => $value) : ?>
                <div><?=  $value  ?></div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    <form method="post">
        <div class="mb-3">
            <label for="titre">titre *</label>
            <input type="text" name="titre" class="form-control" id="titre" value="<?= $data["article"]->getTitre() ?>">
        </div>
        <div class="mb-3">
            <label for="contenu">contenu *</label>
            <textarea name="contenu" id="contenu" cols="30" rows="10" class="form-control"><?= $data["article"]->getContenu() ?></textarea>
        </div><!-- http://192.168.15.22/jour7-tp/admin/article/new -->
        <div class="mb-3">
            <label for="img">url image</label>
            <input type="text" name="img" class="form-control" id="img" value="<?= $data["article"]->getImg() ?>">
        </div>
        <div class="text-end">
            <input type="submit" class="btn btn-primary" value="créer nouvel article">
        </div>
    </form>
</div>