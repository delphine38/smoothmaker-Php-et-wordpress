<?php

class MyFormulaire_Session {

    //on lance tout la session si elle na pas été démarrer
    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();

        }
    }

    //pour ajouter un message
    public function createMessage($type, $message){
        $_SESSION["my-formulaire"] = array("type" => $type, "message" =>$message);
    }

    //recuperer le message
    public function getMessage(){

        return isset($_SESSION["my-formulaire"]) &&
            count($_SESSION["my-formulaire"]) > 0 ? $_SESSION["my-formulaire"] : false;
    }

    //fonction pour détruire le message
    public function destroy(){
        $_SESSION["my-formulaire"] = array();
    }
}
