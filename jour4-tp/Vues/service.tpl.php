
<!-- card -->
<div class="container mt-3">
  <h1><?= $data["h1"] ?></h1>
  <div class="row ">
      <?php foreach($data["card"] as $key => $value) : ?>
          <div class="col-4  my-5">
            <div class="card text-center">
              <h5 class="card-header <?= $key === 2 ? "bg-dark text-white " : "" ?>"><?= $value["h1"] ?></h5>
                <div class="card-body ">
                    <h5 class="card-title"><?= $value["h2"] ?></h5>
                    <p class="card-text"><?= $value["p"] ?></p>
                    <a href="#" class="btn border-dark col-12 
                    <?= $key === 0 ? "btn-outline-dark " : "" ?>
                    <?= $key === 1 ? "btn-dark text-white " : "" ?>   <?= $key === 2 ? "bg-dark text-white" : "" ?> "><?= $value["btn"] ?></a>
                </div>
            </div>
          </div>
      <?php endforeach ?> 
    </div>
</div>
  