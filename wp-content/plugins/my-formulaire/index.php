<?php
/*
 * Plugin Name: My formulaire
 * Plugin URI: https://delphine.fr/plugin-qui-nexiste-pas-en-vrai
 * Description: Plugin de formulaire créé en cours
 * Version: 1.0
 * Author: Delphine
 * Author URI: https://delphine.fr/
 * License: GPL2
 */

//on fait appel à la page qui contient le code du widget afin de pouvoir le charger
require_once 'formulairewidget.php';


class MyFormulaire
{
    public function __construct()
    {

        /**
         * Lorsque Wordpress est prêt à charger les widgets (widget_init), nous lui demandons de recenser le notre en renseignant le nom de la classe du widget
         */
        add_action('widgets_init', function () {
            register_widget('MyFormulaire_Widget');
        });


        /**
         * __FILE__ permet de pointer vers le fichier courant
         * on indique ensuite le nom de la classe et de la méthode à lancer
         * on renseigne le nom de la classe et non une instance de cette dernière car la méthode install() et une méthode statique, donc relative à la classe.
         */
        register_activation_hook(__FILE__, array('MyFormulaire', 'install'));

        //appel de la méthode uninstall() à la désinstallation du plugin
        register_uninstall_hook(__FILE__, array('MyFormulaire', 'uninstall'));

        //fonction qui est appelée à l’instant où l’application est chargée et où elle s’apprête à effectuer le rendu du thème pour la page demandée
        add_action('wp_loaded', array($this, 'saveEmail'));


    }

    public function saveEmail()
    {
        //s'il y a une clé [email] dans le $_POST, on vient le récupérer pour l'enregistrer dans la base
        if (isset($_POST['my-email']) && !empty($_POST['my-email'])) {

            //on stocke la valeur saisie dans l'input dans une variable
            $email = $_POST['my-email'];

            if(is-email($email)) {

                //on récupère de nouveau l'instance de la classe permettant de manipuler la BDD
                global $wpdb;

                $user = $wpdb->get_row("
                   SELECT * FROM {$wpdb->prefix}my_formulaire
                   WHERE email= '$email'; 
                   ");

                if (is_null($user)) {
                    $datas = array("email" => $email);


                    if (isset($_POST['my-formulaire-mail']) && !empty($_POST['my-formulaire-mail'])) {
                        $datas["name"] = $_POST['my-formulaire-mail'];
                    }


                    //on execute la requete sql d'insert qui vient rajouter les données
                    $wpdb->insert("{$wpdb->prefix}my_formulaire", $email);
                }

                else{}//erreur mail non renseigner
            }





            /**
             * on fait une requête SELECT pour vérifier s'il n'est pas déjà dans la base.
             * retourne null en cas d'échec
             */
            $user = $wpdb->get_row("
                SELECT * FROM {$wpdb->prefix}my_formulaire 
                WHERE email = 'my-email'
            ");

            //on ne veut insérer l'email que s'il n'est pas déjà dans la base et que donc $user est null
            if (is_null($user)) {

                /**
                 * la méthode insert attend 2 informations :
                 * - le nom de la table dans laquelle insérer
                 * - les données à insérer sous la forme d'un tableau associatif ["nom_colonne" => valeur]
                 */
                $wpdb->insert("{$wpdb->prefix}my_formulaire", array('email' => $email));
            }
        }
    }



    public static function install()
    {
        //on récupère l'instance de la classe permettant de manipuler la BDD
        global $wpdb;

        /**
         * On vient créer la table, si elle n'existe pas déjà
         * $wpdb->prefix : contient le préfixe défini à la création pour cette BDD
         * l'id est autoincrémenté et l'email doit être unique
         */
        $wpdb->query("
        CREATE TABLE IF NOT EXISTS {$wpdb->prefix}my_formulaire 
        (id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE);
        name VARCHAR (50) NULL
            ");
        }

    public static function uninstall()
    {
        global $wpdb;

        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}my_formulaire;");
    }



}

//on instancie notre classe
new MyFormulaire();
