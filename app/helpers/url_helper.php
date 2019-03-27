<?php
 
   //para redireccionar la pagina
   function redireccionar($pagina){
       header('Location: '.RUTA_URL.$pagina);
   }
?>