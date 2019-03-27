<?php

/*
Mapear la url ingresadas en el navegador
1-controlador
2-metodos
3-parametros

ejemplo /articulos/actualizar/4*/

class Core{
    protected $controladorActual='controlleur';
    protected $metodoActual='index';
    protected $parametros=[];

    //constructeur
    public function __construct(){
        
       // print_r($this->getUrl());
          $url = $this->getUrl();
          //buscar en controladores si el controlador existe
          if(file_exists('../app/controller/'.ucwords($url[0]).'.php')){
             //si existe se setea como controlador por defecto
             $this->controladorActual=ucwords($url[0]);
            
             //unset indice
            unset($url[0]);
            }
            //requerir el controlador
            include_once '../app/controller/'.$this->controladorActual . '.php';
            $this->controladorActual= new $this->controladorActual;
   
            //chequear la segunda parte de la url que serie el metodo
            if(isset($url[1])){
                if(method_exists($this->controladorActual, $url[1])){
                    //chequeamos el metodo
                    $this->metodoActual=$url[1];
                    //unset indice
                    unset($url[1]);
                }
            }
            //para probar traer el metodo
            //echo $this->metodoActual;

            //obtener los parametros
            $this -> parametros=$url? array_values($url) : [];

            //llamar callback con parametros array
            call_user_func_array([$this->controladorActual,$this->metodoActual],$this->parametros);

   
    }

    public function getUrl(){
        //echo $_GET['url'];

        if(isset($_GET['url'])){
            $url=rtrim($_GET['url'],'/');
            $url=filter_var($url,FILTER_SANITIZE_URL);
            $url=explode('/', $url);

            return $url;
        }
    }
}
?>