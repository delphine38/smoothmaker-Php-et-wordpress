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
require_once 'formulairesession.php';


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

        add_action('init', array('MyFormulaire', 'loadFiles'));


        /**
         * __FILE__ permet de pointer vers le fichier courant
         * on indique ensuite le nom de la classe et de la méthode à lancer
         * on renseigne le nom de la classe et non une instance de cette dernière car la méthode install() et une méthode statique, donc relative à la classe.
         */
        register_activation_hook(__FILE__, array('MyFormulaire', 'install'));

        //appel de la méthode uninstall() à la désinstallation du plugin
        register_uninstall_hook(__FILE__, array('MyFormulaire', 'uninstall'));

        //charger les fichiers
        add_action("init", array($this, "loadFiles"));


        //fonction qui est appelée à l’instant où l’application est chargée et où elle s’apprête à effectuer le rendu du thème pour la page demandée
        add_action('wp_loaded', array($this, 'saveEmail'), 10);
        add_action('wp_loaded', array($this, 'checkInfo'), 20);
        //add_action permet de déclancher l'action au chargement

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

    public function saveEmail()
    {
        $myFormulaire_Session = new MyFormulaire_Session();


        //s'il y a une clé [email] dans le $_POST, on vient le récupérer pour l'enregistrer dans la base
        if (isset($_POST['my-email']) && !empty($_POST['my-email'])) {

            //j'instancie my-formulaire_session


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
                   $result = $wpdb->insert("{$wpdb->prefix}my_formulaire", $datas);
                    //message pour dire que l'utilisateur a bien été ajouter a la newsletter

                    if($result === false) {
                        $myFormulaire_Session->createMessage("error", "Une erreur est survenue, veuillez réessayer ulterieurement");
                    }else{
                        $myFormulaire_Session->createMessage("success", "Bien inscrit à la newsletter");

                    }

                     } else {
                        //erreur déjà inscrit en base de données
                        $myFormulaire_Session->createMessage("error", "Déjà inscrit à la newsletter");
                    }
                        }else{
                            //erreur mauvais mail
                            $myFormulaire_Session->createMessage("error", "Email incorrect");

                        }
                            }else{
                            //erreur mail non renseigner
                            $myFormulaire_Session->createMessage("error", "Vous n'avez pas mis d'email");
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

        //affiche le message
    public function checkInfo(){
        $myFormulaire_Session = new MyFormulaire_Session();

        $message = $myFormulaire_Session->getMessage();
        if($message){
            echo ("
                <p class='my-formulaire-info " . $message["type"] . "'>
                    " . $message["message"] . "
                </p>
            ");
            //methode destroy() pour supprimer les messages
            $myFormulaire_Session->destroy();
        }

    }

    public function loadFiles(){

        //on veut charger le js
        wp_register_script("my-formulaire-js", plugins_url("main.js", __FILE__));
        wp_enqueue_script("my-formulaire-js");

        //on veut charger le css
        wp_register_style("my-formulaire-css", plugins_url("style.css", __FILE__));
        wp_enqueue_style("my-formulaire-css");
    }


    public static function uninstall()
    {
        global $wpdb;

        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}my_formulaire;");
    }



}

//on instancie notre classe
new MyFormulaire();
