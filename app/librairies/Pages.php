<?php

//clase controlador principal
//se encarga de poder cargar los modelos y  las vistas


class Pages{

    //cargar modelo
    public function modele($modele){
        //incluir
        require '../app/modele/'.$modele.'.php';
        //instanciar el modelo
        return new $modele();
    }
    
    //cargar vista
    public function vue($vue){
 
        //chequear si el archivo vista existe
        if(file_exists('../app/vues/'.$vue.'.php')){
            require_once '../app/vues/'.$vue.'.php';
        }else{
            // si el archivo de la vista no existe
            die('la vue existe pas');
        }
    }
}
?>