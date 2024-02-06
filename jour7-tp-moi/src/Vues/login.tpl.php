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
            <label for="email">email *</label>
            <input type="email" name="email" class="form-control" id="email" >
        </div>
        <div class="mb-3">
            <label for="password">password *</label>
            <input type="password" name="password" class="form-control" id="password">
        </div><!-- http://192.168.15.22/jour7-tp/admin/article/new -->
       
        <div class="text-center">
            <input type="submit" class="btn btn-outline-success" value="Connexion">
        </div>
    </form>
</div>