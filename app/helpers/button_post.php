<?php

$action=(isset($_POST['action']))? $_POST['action']:"";
$idTask=(isset($_POST['idTask']))? $_POST['idTask']:"";
$crud="";
$textName="";
$textApellido="";
$data=[
    'nom'=>'',
    'apellido'=>'',
];
$con= new Requete;

switch($action){

    case "ajouter task":
    $donnees=[
        'nom'=>trim($_POST['nom']),
        'apellido'=>trim($_POST['apellido']),
    ];

    $con->ajouterTask($donnees)
    

    break;

    case "editer":
    
    $crud=RUTA_URL.'/controlleur/update/'.$idTask.'/';
    foreach($donnees['tasks'] as $task){
        if($task->id==$idTask){
         $data=[
           'nom'=>$task->nom,
           'apellido'=>$task->apellido,
         ];
        }
    }
    break;
    case "effacer":
      $con->deleteTask($idTask);

    break;
}

?>