<?php 

class ErreurController extends AbstractController{

    public function erreur404(){
        $data = [
            "title" => "page introuvable",
            "h1" => "Erreur 404, page introuvable"
        ];

        $this->render("404", $data);
    }

}
