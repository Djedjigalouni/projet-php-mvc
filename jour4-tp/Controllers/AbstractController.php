<?php 

class AbstractController{

    // utiliser render dans la class AbstractController
    // et dans ses enfants PageController / ErreurController
    // uniquement
    protected function render(string $page , array $data = [] ) :void{
        require_once __DIR__ . "/../Vues/header.tpl.php";
        require_once __DIR__ . "/../Vues/$page.tpl.php";
        require_once __DIR__ . "/../Vues/footer.tpl.php";
    }

}
