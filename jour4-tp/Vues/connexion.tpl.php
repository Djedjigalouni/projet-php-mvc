<div class="container">
    <h1 class="text-center mt-5 mb-5"><?= $data["h1"] ?></h1>
    <section class="row d-flex justify-content-center">
        <div class="col-3">
            <form >
                <div class="form-floating mb-3">
                    <input type="email" placeholder="login" class="form-control" id="login">
                    <label for="login">login</label>
                </div>
            </form>
        </div>
        <div class="col-3">
            <form >
                <div class="form-floating mb-3 ">
                    <input type="text" placeholder="password" class="form-control" id="password">
                    <label for="password">password</label>
                   
                </div>
                 
            </form>
            
        </div>
        <div class="d-flex justify-content-center "><button class="btn btn-dark ">Connexion</button></div>
    </section>
</div>