<?php

class MyFormulairvoitureeadmin
{

    public function __construct()
    {
        add_action("admin_menu", array($this, "addAdminMenu"));
    }

    public function  addAdminMenu()
    {
        add_menu_page(
            "tirageausort",

            //titre de la page
            "Tirage au sort delphine- plugin de tirage au sort",

            //le nom qui apparait dans l'onglet de gauche
            "Inscrit",

            //les droits de l'utilisateur : tout ceux qui ont des droits d'admin
            "manage_options",

            //le slug
            "Inscrit",
            array($this, "generateMainHtml")
        );

        add_submenu_page(
            "tirageausort",
            "Inscrit",
            "Inscrit",
            "manage_options",
            "tirageausort",
            array($this, "generateSubscriberHtml"),

        );
    }




    public function generateMainHtml(){
        echo "<h1>" .get_admin_page_title(). "</h1>";
        echo "Affiche la liste des pesonnes inscrites";



    }


    public function genHtmlList(){
        $suscribers = $this->getAllSuscribers();

        $html = "<table class='tirage' style='border-collapse: collapse'>
                    <thead>
                        <tr>
                            <th>Nom : </th>
                            <th>Prénom : </th>
                            <th>Email : </th>
                            <th>Date de naissance : </th>
                            <th>Ville : </th>
                        </tr>
                     </thead>
               ";
        foreach ($suscribers as $suscriber) {
            $html .= "<tr>
                       <td style='width: 150px; border: 1px solid black'>Nom : {$suscriber->name}</td>
                       <td style='width: 150px; border: 1px solid black'>Prénom : {$suscriber->firstname}</td>
                       <td style='width: 150px; border: 1px solid black'>Email : {$suscriber->email}</td>
                       <td style='width: 150px; border: 1px solid black'>Date de naissance : {$suscriber->year}</td>
                       <td style='width: 300px; border: 1px solid black'>Ville : {$suscriber->city}</td>
                </tr>";
        }

    }



    public function generateSubscriberHtml()
    {
        echo "<h1>" . get_admin_page_title() . "</h1>";
        echo $this->genHtmlList();

    }

    public function shortcodeSubscribersList(){
        return $this->genHtmlList();

    }


    //j'externalise pour faire une requete sql et retourner les données
    public function getAllSuscribers(){
        global $wpdb;

        $suscribers = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}voiture");
        return $suscribers;
    }


}


