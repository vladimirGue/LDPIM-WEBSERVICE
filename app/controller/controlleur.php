<?php

class controlleur extends Pages{

    public function __construct()
    {
       $this->task_modele=$this->modele('Requete');
    }

    public function index(){

        $this->vue('pages/login');
    }
    public function accuil(){
        $this->vue('pages/accuil');

    }
    public function getTodo(){
        //je prends tous les donnees de la base  
        $tasks=$this->task_modele->getTask();
        $donnees=[
                'tasks'=>$tasks
        ];
        $user=$this->task_modele->getTodoUser();
        $dataUser=[
            'datauser'=>$user
        ];
    ?>
    <table class="table">
        <thead>
        <tr>
           <th>ID</th>
           <th>DATE</th>
           <th>TACHE</th>
           <th>ACTIONS</th>
        </tr>
        </thead>
        
            <tbody>
            <?php foreach($donnees['tasks'] as $task){ ?>
              <tr>
               <td><?php echo $task->id ?></td>
               <td><?php echo $task->date ?></td>
               <td><?php echo $task->tache ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             affecter tache
                         </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php  foreach($dataUser['datauser'] as $data){ ?>
                            <input type="submit" class="dropdown-item" id-tache="<?php echo $task->id;?>" name="iduser" id-user="<?php echo $data->Id;?>" value="<?php echo $data->nom;?>">
                        <?php } ?>
                        </div>
                    </div>
               </td>
               <td>
               <form id="idformtabl">
                 <input type='submit' class='btn btn-warning' name='editer' id="<?php echo $task->id ?>" value='editer'>
                 <input type='submit' class='btn btn-danger' name="effacer" id="<?php echo $task->id ?>" value='effacer'>
                 </form>
               </td>
              </tr>
           <?php } ?>
            </tbody>
     </table>

<script type="text/javascript" src="<?php echo RUTA_URL; ?>/js/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_URL; ?>/js/table.js"></script>
 
 <?php
    }

    public function ajouter(){
        //j'ajoute le task à la base de donnees  
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $data=[
                'date'=>trim($_POST['id-date']),
                'tache'=>trim($_POST['tache']),
                'id-tacheA'=>trim($_POST['id-tacheUser']),
            ];
            $task=$this->task_modele->ajouterTask($data);
            $donnees=[
                'tasks'=>$task
             ];   
        }
        $user=$this->task_modele->getTodoUser();
        $dataUser=[
            'datauser'=>$user
        ];
?>
      <table class="table">
        <thead>
        <tr>
           <th>ID</th>
           <th>DATE</th>
           <th>TACHE</th>
           <th>ACTIONS</th>
        </tr>
        </thead>
        
            <tbody>
            <?php foreach($donnees['tasks'] as $task){ ?>
              <tr>
               <td><?php echo $task->id ?></td>
               <td><?php echo $task->date ?></td>
               <td><?php echo $task->tache ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             affecter tache
                         </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php  foreach($dataUser['datauser'] as $data){ ?>
                            <a class="dropdown-item" name="iduser" id-user="<?php echo $data->Id;?>"><?php echo $data->nom;?></a>
                        <?php } ?>
                        </div>
                    </div>
               </td>
               <td>
               <form id="idformtabl">
                 <input type='submit' class='btn btn-warning' name='editer' id="<?php echo $task->id ?>" value='editer'>
                 <input type='submit' class='btn btn-danger' name='effacer' id="<?php echo $task->id ?>" value='effacer'>
                 </form>
               </td>
              </tr>
           <?php } ?>
            </tbody>
     </table>

<script type="text/javascript" src="<?php echo RUTA_URL; ?>/js/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_URL; ?>/js/table.js"></script>
<?php
    }

    public function getId(){

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $donnees=$_POST['id'];
        $task=$this->task_modele->getTaskId($donnees);
        echo $task;

        }
        
    }

    public function update(){
        //je met à jour les donnees
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $data=[
                'id'=>trim($_POST['id']),
                'date'=>trim($_POST['date']),
                'tache'=>trim($_POST['tache']),
            ];
            $tasks=$this->task_modele->updateTask($data);
            $donnees=[
                'tasks'=>$tasks
             ];   
        }
        $user=$this->task_modele->getTodoUser();
        $dataUser=[
            'datauser'=>$user
        ];
?>
      <table class="table">
        <thead>
        <tr>
           <th>ID</th>
           <th>DATE</th>
           <th>TACHE</th>
           <th>ACTIONS</th>
        </tr>
        </thead>
        
            <tbody>
            <?php foreach($donnees['tasks'] as $task){ ?>
              <tr>
               <td><?php echo $task->id ?></td>
               <td><?php echo $task->date ?></td>
               <td><?php echo $task->tache ?>
                     <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             affecter tache
                         </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php  foreach($dataUser['datauser'] as $data){ ?>
                            <a class="dropdown-item" name="iduser" id-user="<?php echo $data->Id;?>"><?php echo $data->nom;?></a>
                        <?php } ?>
                        </div>
                    </div>
               </td>
               <td>
               <form id="idformtabl">
                 <input type='submit' class='btn btn-warning' name='editer' id="<?php echo $task->id ?>" value='editer'>
                 <input type='submit' class='btn btn-danger' name='effacer' id="<?php echo $task->id ?>" value='effacer'>
                 </form>
               </td>
              </tr>
           <?php } ?>
            </tbody>
     </table>

<script type="text/javascript" src="<?php echo RUTA_URL; ?>/js/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_URL; ?>/js/table.js"></script>
<?php
    }

    public function delete(){

        //j'efface les donnees de la base
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $data=[
                'id'=>trim($_POST['id']),
            ];
            $tasks=$this->task_modele->deleteTask($data);
            $donnees=[
                'tasks'=>$tasks
             ];   
        }
        $user=$this->task_modele->getTodoUser();
        $dataUser=[
            'datauser'=>$user
        ];
?>
      <table class="table">
        <thead>
        <tr>
           <th>ID</th>
           <th>DATE</th>
           <th>TACHE</th>
           <th>ACTIONS</th>
        </tr>
        </thead>
        
            <tbody>
            <?php foreach($donnees['tasks'] as $task){ ?>
              <tr>
               <td><?php echo $task->id ?></td>
               <td><?php echo $task->date ?></td>
               <td><?php echo $task->tache ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             affecter tache
                         </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php  foreach($dataUser['datauser'] as $data){ ?>
                            <a class="dropdown-item" name="iduser" id-user="<?php echo $data->Id;?>"><?php echo $data->nom;?></a>
                        <?php } ?>
                        </div>
                    </div>
               </td>
               <td>
               <form id="idformtabl">
                 <input type='submit' class='btn btn-warning' name='editer' id="<?php echo $task->id ?>" value='editer'>
                 <input type='submit' class='btn btn-danger' name='effacer' id="<?php echo $task->id ?>" value='effacer'>
                 </form>
               </td>
              </tr>
           <?php } ?>
            </tbody>
     </table>

<script type="text/javascript" src="<?php echo RUTA_URL; ?>/js/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_URL; ?>/js/table.js"></script>
<?php
    }

    public function userFacebook(){
        include_once RUTA_APP.'/config/fbConfig.php';
          
            // Obtener la liga de inicio de sesión
            $loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
            
            // imprimir botón de login
            $output = '<a  class="btn " style="background: blue;color:white;" href="'.htmlspecialchars($loginURL).'">connexion sous Facebook</a>';
            echo $output;

    }

    public function ajouterUser(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $data=[
                'nom'=>trim($_POST['nom']),
                'prenom'=>trim($_POST['prenom']),
                'role'=>trim($_POST['role'])
            ];
        $this->task_modele->ajouterU($data); 
        }
    }

    public function affecterTache(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $data=[
                'id-user'=>trim($_POST['id-user']),
                'id-tache'=>trim($_POST['id-tache'])
            ];
            $this->task_modele->ajouterTacheUser($data);
        }
    }
}
?>