<?php
/*
 * Plugin Name: Voiture
 * Plugin URI: https://delphine.fr/plugin de voiture-qui-nexiste-pas-en-vrai
 * Description: Plugin de voiture en cours de création
 * Version: 1.0
 * Author: Delphine
 * Author URI: https://delphine.fr/
 * License: GPL2
 */


//on fait appel à la page qui contient le code du widget afin de pouvoir le charger
require_once 'formulairevoiture.php';


class formulaire extends WP_Widget{
    public function __construct(){
        parent::__construct( 'formulaire', 'Formulaire voiture', array( 'description' => "Formulaire d'ajout de voiture'." ) );

        add_action("widget init", function (){
            register_widget("formulairewidget");
        });
    }


    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo $instance['title'];
        echo $args['after_title'];
        echo $args['after_widget'];
        echo('
<form action="" method="POST"><p>
    <label for="formulaire-name">Votre Nom :</label><input type="text" name="name" id="formulaire-name">
    <label for="formulaire-brand">La marque de votre voiture :</label><input type="text" name="brand" id="formulaire-brand">
    <label for="formulaire-model">Votre model :</label><input type="text" name="model" id="formulaire-model">
    <label for="formulaire-year">Votre year :</label><input type="number" name="year" id="formulaire-year">
    <label for="formulaire-plaque">Votre plaque d\'imatriculation :</label><input type="text" name="plaque" id="formulaire-plaque">
</p><input type="submit" value="S\'inscrire">
</form>');
    }

}
new Formulaire();
