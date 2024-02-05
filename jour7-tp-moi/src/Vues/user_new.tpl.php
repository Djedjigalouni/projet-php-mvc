<div class="container">
    <h1><?= $data["h1"] ?></h1>
    <?php if(!empty($data["erreur"])) :?>
        <div class="alert alert-danger">
            <?php foreach($data["erreur"] as $key => $value) : ?>
                <div><?=  $value  ?></div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    <div class="row">
    <form method="post" class= "col-6 offset-3 ">
        <div class="mb-3">
            <label for="email">email *</label>
            <input type="email" name="email" class="form-control" id="email" >
        </div>
        
        <div class="mb-3">
            <label for="password">votre password *</label>
            <input type="password" name="password" class="form-control" id="password" >
        </div>
        <div class="text-end">
            <input type="submit" class="btn btn-primary" value="créer nouveau profil">
        </div>
    </form>
    </div>
</div>