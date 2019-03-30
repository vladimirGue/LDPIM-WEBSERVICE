<?php

   class Requete{
       private $db;

       public function __construct(){
           $this->db=new Base;
       }

       public function getTask(){
           $this->db->query("select * from prueba");

           $result=$this->db->registros();

           return $result;
       }

       
       public function ajouterTask($donnees){

        $this->db->query("INSERT INTO prueba (date,tache) VALUES(:date,:tache)");

            //lier valeurs
            $this->db->bind(':date',$donnees['date']);
            $this->db->bind(':tache',$donnees['tache']);

            //executer
            $this->db->execute();

            //si l'utilisateur sélectionne un ou différents utilisateur la requete suivant s'execute
           if(isset($donnees['id-tacheA'])){
                $resultat=$donnees['id-tacheA'];

                $this->db->query("UPDATE user SET taches=CONCAT(taches,',',:taches), nombre=nombre+1 where id IN (".$resultat.")");
                $this->db->bind(':taches',$donnees['tache']);

                $this->db->execute();
                
           }
           
           //j'obtiens les resultat pour le montrer
           $this->db->query("select * from prueba");
           $result=$this->db->registros();
           
           return $result;
           
       }

       
       //obtenir l'di d'utilisateur
       public function getTaskId($id){
        $this->db->query("SELECT * FROM prueba WHERE id=:id");
        $this->db->bind(':id',$id);

        $row=$this->db->registro();

        return json_encode($row);
       }

       public function updateTask($donnees){
           $this->db->query("UPDATE prueba SET date=:date, tache=:tache WHERE id=:id");

           //lier valeurs

           $this->db->bind(':id', $donnees['id']);
           $this->db->bind(':date', $donnees['date']);
           $this->db->bind(':tache', $donnees['tache']);
           
           //executer
           $this->db->execute();

           $this->db->query("select * from prueba");
           $result=$this->db->registros();
           
           return $result;
           
       }

       public function checkUser($donnees){
               //verifier si l'information d'utilisateur existe déjà
               if(!empty($donnees)){
               $this->db->query("SELECT * FROM oauth where oauth_provider=:oauth_provider AND oauth_uid=:oauth_uid");

               //lier valeurs
               $this->db->bind(':oauth_provider',$donnees['oauth_provider']);
               $this->db->bind(':oauth_uid',$donnees['oauth_uid']);
               $result=$this->db->registro();
               $resultRow=$this->db->rowCount();
               if($resultRow>0){
                   $this->db->query("UPDATE oauth SET first_name=:first_name, last_name=:last_name, picture=:picture, modified=:modified WHERE oauth_provider=:oauth_provider AND oauth_uid=:oauth_uid  ");

                   //lier valeurs
                   $this->db->bind(':first_name',$donnees['first_name']);
                   $this->db->bind(':last_name',$donnees['last_name']);
                   $this->db->bind(':picture',$donnees['picture']);
                   $this->db->bind(':modified',date("Y-m-d H:i:s"));
                   $this->db->bind(':oauth_provider',$donnees['oauth_provider']);
                   $this->db->bind(':oauth_uid',$donnees['oauth_uid']);
                 
                   $this->db->execute();
                }else{
                    $this->db->query("INSERT INTO oauth (oauth_provider, oauth_uid, first_name, last_name,picture, created, modified) VALUES(:oauth_provider,:oauth_uid,:first_name,:last_name,:picture,:created,:modified) ");
               
                    $this->db->bind(':oauth_provider',$donnees['oauth_provider']);
                    $this->db->bind(':oauth_uid',$donnees['oauth_uid']);
                    $this->db->bind(':first_name',$donnees['first_name']);
                   $this->db->bind(':last_name',$donnees['last_name']);
                   $this->db->bind(':picture',$donnees['picture']);
                   $this->db->bind(':created',date("Y-m-d H:i:s"));
                   $this->db->bind(':modified',date("Y-m-d H:i:s"));

                   $this->db->execute();
                }
    
            }
                //prendre l'information
           
           return $result;

    }

       public function deleteTask($donnees){

        $this->db->query("DELETE FROM prueba WHERE id=:id");

        //lier valeurs
        $this->db->bind(':id', $donnees['id']); 

        //executer
        $this->db->execute();

        $this->db->query("select * from prueba");
           $result=$this->db->registros();
           
           return $result;
         
       }

       //methode pour ajouter des utilisateur
       public function ajouterU($donnees){

            $this->db->query("INSERT INTO user (nom,prenom,role) VALUES(:nom,:prenom,:role)");
            $this->db->bind(':nom',$donnees['nom']);
            $this->db->bind(':prenom',$donnees['prenom']);
            $this->db->bind(':role',$donnees['role']);

            $this->db->execute();
       }

       //methode pour prendre tous les utilisateur et les montrer
       public function getTodoUser(){
           $this->db->query("SELECT * FROM user");

           $resultat=$this->db->registros();

           return $resultat;
       }

       //methode pour ajouter une tache
       public function ajouterTacheUser($donnees){
            $this->db->query("SELECT * FROM prueba where id=:id");
            $this->db->bind(':id',$donnees['id-tache']);
            $result=$this->db->registroO();

            $this->db->query("UPDATE user SET taches=:taches, nombre=nombre+1 where id=:id");
            $this->db->bind(':id',$donnees['id-user']);
            $this->db->bind(':taches',$result->tache);
            $this->db->execute();

            return $result;

       }
   }
?>