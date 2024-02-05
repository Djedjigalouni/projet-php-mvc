<div class="container">
    <h1 class="display-4"><?= $data["h1"] ?></h1>
    <section class="row">
        <!-- .col-4*6>article.card.mb-3>(h2.card-header.h4>lorem3)+img[src="https://via.placeholder.com/400x300"]+div.card-body>p>lorem20 -->
        <?php foreach ( $data["articles"] as $key => $value ) : ?>
        <div class="col-4">
            <article class="card mb-3">
                <h2 class="card-header h6"><?= $value->getTitre() ?></h2>
                <img src="<?= $value->getUrlImg() ?>" alt="" style="height:150px;object-fit:cover">
                <div class="card-body">
                    <p><?= $value->lireLaSuite() ?></p>
                </div>
                <div class="card-footer text-end">
    <a href="<?= $router->generate("article" , ["id" => $value->getId()]) ?>" class="btn btn-primary">lire la suite</a>
                </div>
            </article>
        </div>
        <?php endforeach ?>
       
    </section>
</div>
   