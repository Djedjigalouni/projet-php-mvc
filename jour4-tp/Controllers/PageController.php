<?php 
// créer le fichier PageController.php
// class contient du code qui est exécuté AVANT 
// la partie affichage
class PageController extends AbstractController {
    // méthode que l'on va exécuter dans le fichier index.php 
    // $p = new PageController()
    // $p->home(); 
    public function accueil() :void {

        $data = [];
        $data["title"] = "Homepage";

        $images = [];
        for($i = 1 ; $i < 8 ; $i++){
            $images[] = "https://source.unsplash.com/random/1500x300?v$i";
        }

        $data["diapositives"] = $images;
        //Card image
        $data["articles"] =
        [
        [ 
            "image"=> "https://source.unsplash.com/random/1500x300?v1",
            "title" => "Lorem, ipsum",
            "p" =>"Lorem ipsum dolor sit ea quidem ut facere enim obcaecati et! In, repellat?",
        ],
        [ 
            "image"=> "https://source.unsplash.com/random/1500x300?v2",
            "title" => "Lorem, ipsum",
            "p" =>"Lorem ipsum dolor sit ea quidem ut facere enim obcaecati et! In, repellat?",
        ],
        [ 
            "image"=> "https://source.unsplash.com/random/1500x300?v3",
            "title" => "Lorem, ipsum",
            "p" =>"Lorem ipsum dolor sit ea quidem ut facere enim obcaecati et! In, repellat?",
        ],
        [ 
            "image"=> "https://source.unsplash.com/random/1500x300?v4",
            "title" => "Lorem, ipsum",
            "p" =>"Lorem ipsum dolor sit ea quidem ut facere enim obcaecati et! In, repellat?",
        ],
        
        [ 
            "image"=> "https://source.unsplash.com/random/1500x300?v10",
            "title" => "Lorem, ipsum",
            "p" =>"Lorem ipsum dolor sit ea quidem ut facere enim obcaecati et! In, repellat?",
        ],
        [ 
            "image"=> "https://source.unsplash.com/random/1500x300?v6",
            "title" => "Lorem, ipsum",
            "p" =>"Lorem ipsum dolor sit ea quidem ut facere enim obcaecati et! In, repellat?",
        ],
        [ 
            "image"=> "https://source.unsplash.com/random/1500x300?v7",
            "title" => "Lorem, ipsum",
            "p" =>"Lorem ipsum dolor sit ea quidem ut facere enim obcaecati et! In, repellat?",
        ],
        [ 
            "image"=> "https://source.unsplash.com/random/1500x300?v8",
            "title" => "Lorem, ipsum",
            "p" =>"Lorem ipsum dolor sit ea quidem ut facere enim obcaecati et! In, repellat?",
        ],

        ];
        
        
        $data["h1"] = "Nos derniers articles :";

        $this->render("accueil" , $data );



    }

    public function service() :void{

        $data = [
            "title" => "page de service",
            "h1" =>  "Nos Service" ,
            "card" =>[
            [
                "h1"=> "Free" ,
                "h2" => "$0<small class='text-secondary fw-normal'>/mo </small>" ,
                "p" =>"10 users included<br> 2GB of storage <br> Email support <br> Help center access.",
                "btn" =>"Sing up for free"
            ],
            [
                "h1" => "Pro" ,
                "h2" => "$15<small class='text-secondary fw-normal'>/mo </small>",
                "p" => "20 users included<br> 10GB of storage <br>  Priority email support <br> Help center access.",
                "btn" =>"Get started"
                
            ],
            [
                "h1" => "Entreprise" ,
                "h2" => "$29<small class='text-secondary fw-normal'>/mo </small>" ,
                "p" => "30 users included<br> 15GB of storage <br>  Phone and email support <br> Help center access.",
                "btn" =>"Contact us"
            ]
        ]];
        

        $this->render("service" , $data);
    }
    public function connexion() :void{
        // avant le render => stocker toutes les valeurs 
        // dont j'ai besoin ici 
        $data = [
            "title" =>"page nous contacter",
            "h1" => "Accedez à l'espace de gestion"
        ] ; 

        $this->render("connexion", $data);
    }

}