
<section class="py-5  mt-5">
    <div class="container border mt-5 py-5 ">
        <h1 class="text-center  my-3"><?= $data["h1"] ?></h1>
        <?php if(!empty($data["erreur"])) :?>
        <div class="alert alert-danger">
        <?php foreach($data["erreur"] as $key => $value) : ?>
            <div><?=  $value  ?></div>
        <?php endforeach ?>
        </div>
        <?php endif ?>
        <div class="row  m-5 text-light">
            <table class="table table-striped text-center border border-2">
                <thead>
                    <tr>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Email</th>
                        <th scope="col">Modifier utilisateur</th>
                        <th scope="col">Supprimer utilisateur</th>
                    </tr>
                </thead>
                <?php foreach($data["users"] as $key => $value) : ?>
                <tbody>
                    <tr>
                        <td><?=  $value->getPseudo()  ?></td>
                        <td><?=  $value->getEmail()  ?></</td>
                        <td><a class="btn btn-outline-primary me-2 justify-content-center" href="<?= $router->generate("admin_user_edit") .$value->getId() ?>" role="button" >Modifier</a></td>
                        <td><a class="btn btn-outline-danger me-2" href="<?= $router->generate("admin_user_delete").$value->getId()  ?>" role="button" >Supprimer</a></td>
                    </tr>
                </tbody>
                <?php endforeach ?>
        </table>
    </div>
</section>