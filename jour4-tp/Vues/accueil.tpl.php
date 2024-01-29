
<div class="container mt-3">
  <section id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
    <?php foreach($data["diapositives"] as $key => $value) : ?>
                <button type="button" data-bs-target="#diapo" data-bs-slide-to="<?= $key ?>" class="active" aria-current="true" aria-label="Slide <?= $key + 1 ?>"></button>
                <?php endforeach ?>
    </div>

    <div class="carousel-inner">
            <?php foreach($data["diapositives"] as $key => $value) : ?>
            <div class="carousel-item <?= $key === 0 ? "active" : "" ?>">
                <img src="<?= $value ?>" alt="" class="d-block w-100 rounded">
            </div>
           <?php endforeach ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>

<section>
  <div class="container mt-3">
    <h1><?= $data["h1"] ?></h1>
    <div class="row ">
      <?php foreach($data["articles"] as $key => $value) : ?>
        <div class="col-3  mt-5">
            <div class="card" >
              <img src="<?= $value["image"] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?= $value["title"] ?></h5>
                <p class="card-text"><?= $value["p"] ?></p>
              </div> 
            </div>
        </div>
      <?php endforeach ?> 
    </div>
  </div>
</section>
   
