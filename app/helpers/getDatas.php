<?php
include_once RUTA_APP.'/modele/Requete.php';

$user = new Requete;

$result=$user->getTodoUser();

$donnees=[
    'users'=>$result
];
