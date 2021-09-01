let message;

//un gestionnaire d'evenement sur page html pour m'assurer que se soit charger
document.addEventListener("DOMContentLoaded", function (){
    message = document.querySelector(".my-formulaire-info");

    //si type est bien différent et qu'il n'est pas null
    if(typeof message !== undefined && message !== null){

        //alors sur la balise j'installe un gestionnaire d'evenement pour que au click,
        //ca appel méthode "hideInfo" (elle vient remove notre notification)
        message.addEventListener("click", hideInfo);
    }
});

function hideInfo(){
    //"hideInfo" (elle vient remove notre notification)
    message.remove();
}
