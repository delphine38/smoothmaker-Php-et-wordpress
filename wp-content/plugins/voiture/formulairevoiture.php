<?php

class formulairevoiture{


    public function __construct()
    {
        add_action("voiture_menu", array($this,"addVoitureMenu"));
    }

    public function addVoitureMenu(){
        add_menu_page(
        //titre de la page
            "Formulaire de voiture - plugin de voiture",

            //le nom qui apparait dans l'onglet de gauche
            "Formulaire de voiture",

            //les droits de l'utilisateur : tout ceux qui ont des droits d'admin
            "manage_options",

            //le slug
            "FormulaireVoiture",
            array($this, "generateMainHtml")
        );
    }
}
