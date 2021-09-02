<?php
/*
 * Plugin Name: Tirage au sort- delphine
 * Plugin URI: https://delphine.fr/plugin-tirage-au-sort-qui-nexiste-pas-en-vrai
 * Description: Plugin de tirage au sort en cours de création
 * Version: 1.0
 * Author: Delphine
 * Author URI: https://delphine.fr/
 * License: GPL2
 */

//on fait appel à la page qui contient le code du widget afin de pouvoir le charger
require_once 'formulairetirageausortadmin.php';

class Formulairetirage{
    //pour lance au démarrage

    public function __construct(){
        //charge la function Install s'applique uniquement quand l'extension s'install
        register_activation_hook(__FILE__, array('formulairetirageausort', 'install'));

        //charge la function Uninstall s'applique uniquement quand l'extension se desinstall
        register_uninstall_hook(__FILE__, array('formulairetirageausort', 'uninstall'));

        new MyFormulairvoitureeadmin();

    }

    public static function install() {
        global $wpdb;

        //On créer une table uniquement si elle n'existe pas
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}tirageausort (id INT(11) NOT NULL AUTO_INCREMENT , name VARCHAR(255) NOT NULL , firstName VARCHAR(255) NOT NULL ,  email VARCHAR(255) NOT NULL ,  date VARCHAR(255) NOT NULL ,  city VARCHAR(255) NOT NULL ");
    }

}
new Formulairetirage();


