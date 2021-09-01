<?php

class MyFormulaireadmin{

    public function __construct()
    {
        add_action("admin_menu", array($this,"addAdminMenu"));
    }

    public function  addAdminMenu(){
        add_menu_page(
            //titre de la page
            "My formulaire - plugin de newsletter",

            //le nom qui apparait dans l'onglet de gauche
            "My Formulaire",

            //les droits de l'utilisateur : tout ceux qui ont des droits d'admin
            "manage_options",

            //le slug
            "MyFormulaire",
            array($this, "generateMainHtml")
        );


        add_submenu_page(
            "MyFormulaire",
            "Aperçu",
            "Aperçu",
            "manage_options",
            "MyFormulaire",
                        array($this, "generateMainHtml"),

        );

        add_submenu_page(
            "MyFormulaire",
            "Liste des inscrits",
            "Inscrits",
            "manage_options",
            "MyFormulaire_List",
            array($this, "generateSubscriberHtml"),

        );
    }

    public function generateMainHtml(){
        echo "<h1>" .get_admin_page_title(). "</h1>";
        echo "Page d'accueil du plugin";

    }

    public function generateSubscriberHtml(){
        echo "<h1>" .get_admin_page_title(). "</h1>";
        echo "Liste des inscrits";
        $suscribers = $this->getAllSuscribers();
        var_dump($suscribers);

    }

    //j'externalise pour faire une requete sql et retourner les données
    public function getAllSuscribers(){
        global $wpdb;

        $suscribers = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}my_formulaire");
        return $suscribers;
    }
}
