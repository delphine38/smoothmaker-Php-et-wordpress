<?php

class formulairevoiture{


    public function __construct()
    {
        add_action("admin_menu", array($this,"addVoitureMenu"));
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
            "formulairevoiture",
            array($this, "generateMainHtml")
        );

        add_submenu_page(
            "formulairevoiture",
            "Aperçu",
            "Aperçu",
            "manage_options",
            "formulairevoiture",
            array($this, "generateMainHtml"),

        );

        add_submenu_page(
            "formulairevoiture",
            "Recente",
            "Recente",
            "manage_options",
            "formulairevoiturerecent",
            array($this, "generateSubscriberHtml"),

        );

    }

    public function generateMainHtml(){
        echo "<h1>" .get_admin_page_title(). "</h1>";
        echo "Page d'accueil du plugin voiture";

        $suscribers = $this->getAllSuscribers();
        if(count($suscribers) >0) {
            echo "Liste des voitures inscrites";
            echo "<table class='formulairevoiture' style='border-collapse: collapse'>
                    <thead>
                        <tr>
                            <th>Nom : </th>
                            <th>Prénom : </th>
                            <th>Marque et modèle de la voiture : </th>
                            <th>Année de fabrication : </th>
                            <th>Plaque d'immatriculation : </th>
                            <th>Email : </th>
                        </tr>
                     </thead>
               ";

            foreach ($suscribers as $suscriber) {
                echo "<tr>
                       <td style='width: 150px; border: 1px solid black'>Nom : {$suscriber->name}</td>
                       <td style='width: 150px; border: 1px solid black'>Prénom : {$suscriber->firstname}</td>
                       <td style='width: 150px; border: 1px solid black'>Marque et Modèle : {$suscriber->brand}, {$suscriber->model}</td>
                       <td style='width: 150px; border: 1px solid black'>Année de fabrication : {$suscriber->year}</td>
                       <td style='width: 300px; border: 1px solid black'>Plaque d'immatriculation : {$suscriber->immatriculation}</td>
                </tr>";
            }

            echo "</tbody></table>";
        }else{
            echo "il n'y a pas d'inscrits";
        }

    }

    public function genHtmlList(){
        $suscribers = $this->getAllSuscribers();
        if(count($suscribers) >0) {
            //$html = "Liste des voitures inscrites";
            $html = "<table class='formulairevoiture' style='border-collapse: collapse'>
                    <thead>
                        <tr>
                            <th>Nom : </th>
                            <th>Prénom : </th>
                            <th>Marque et modèle de la voiture : </th>
                            <th>Année de fabrication : </th>
                            <th>Plaque d'immatriculation : </th>
                            <th>Email : </th>
                        </tr>
                     </thead>
               ";

            foreach ($suscribers as $suscriber) {
                $html .= "<tr>
                       <td style='width: 150px; border: 1px solid black'>Nom : {$suscriber->name}</td>
                       <td style='width: 150px; border: 1px solid black'>Prénom : {$suscriber->firstname}</td>
                       <td style='width: 150px; border: 1px solid black'>Marque et Modèle : {$suscriber->brand}, {$suscriber->model}</td>
                       <td style='width: 150px; border: 1px solid black'>Année de fabrication : {$suscriber->year}</td>
                       <td style='width: 300px; border: 1px solid black'>Plaque d'immatriculation : {$suscriber->immatriculation}</td>
                </tr>";
            }

            $html .= "</tbody></table>";
        }else{
            $html = "<p>il n'y a pas d'inscrits</p>";
        }
        return $html;
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
