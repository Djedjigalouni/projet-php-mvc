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
                <table border="0" cellspacing="2" cellpadding="2">
                    <tr>
                        <td>Pseudo</td>
                        <td>Email</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php foreach($data["users"] as $key => $value) : ?>
                        <tr>
                            <td><?=  $value->getPseudo()  ?></td>
                            <td><?=  $value->getEmail()  ?></td>
                            <td><a class="btn btn-outline-success me-2" href="<?= $router->generate("admin_user_edit") .$value->getId() ?>" role="button" >Modifier</a></td>
                            <td><a class="btn btn-outline-success me-2" href="<?= $router->generate("admin_user_delete").$value->getId()  ?>" role="button" >Supprimer</a></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
</div>
</section>