<?php include RUTA_APP . '/vues/inc/header.php';
      include RUTA_APP.'/helpers/getDatas.php';
?>


<body>
<div class="container">
   <form  id="formPrin">
      <div class="form-row">
         <div class="col-sm-3">
               <input type="hidden" name="id" id="id" class="form-control" value="">
               <input type="datetime-local" name="date" id="date" class="form-control" value="2017-06-01T08:30">
         </div>
         <div class="col-sm-4">
            <input type="text" name="tache" id="tache" class="form-control" value="">
         </div>
         <div class="col-sm-5">  
            <input type="submit"  class="btn btn-success" name="action"  id="ajout" value="ajouter task">
            <input type="submit"  class="btn btn-warning" name="action"  id="modifier" value="modifier task">
            <select  id="chkveg" multiple="multiple">
               <?php foreach($donnees['users'] as $option) {?>
               <option value="<?php echo $option->Id;?>"><?php echo $option->prenom; ?></option>
               <?php } ?>
            </select><br /><br />
         </div>
         </div>
      </div>
   </form>
   <span id="erreur"></span>
</div>
<br>
<!--button modal-->
<div class="container">
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Ajouter User</button>
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">regarder les utilisatreurs</button>
</div>

<!--container pour la table des taches-->
<div class="container" id="tabl"></div>
<!--MODAL AJOUTER USER-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <h3>Ajouter User</h3>
         <form id="formAjoutUser">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text">Prenom et Nom</span>
               </div>
               <input type="text" placeholder="Prenom" id="prenom" name="prenom" class="form-control">
               <input type="text" placeholder="Nom" id="nom" name="nom" class="form-control">
            </div>
            <br>
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text">le Role</span>
               </div>
               <input type="text" id="role" name="role" class="form-control">
            </div>
            <span id="fait"></span>
            <br>
            <br>
            <br>
            <input type="submit" class="btn btn-success" name="ajouterUser" id="ajouterUser" value="ajouter User">
            <input type="button" class="btn btn-info" data-dismiss="modal" value="annuler" aria-label="Close">
         </form>
    </div>
  </div>
</div>
<!-- MODAL VUE D'UTILISATEURS-->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Utilisateurs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table class="table">
               <thead>
                  <tr>
                     <th>NOM</th>
                     <th>PRENOM</th>
                     <th>ROLE</th>
                     <th>TACHES</th>
                     <th>NOMBRE DE TACHES</th>
                  </tr>
               </thead>
               <tbody>
               <?php foreach($donnees['users'] as $users){ ?>
                  <tr>
                     <td><?php  echo $users->nom; ?></td>
                     <td><?php  echo $users->prenom; ?></td>
                     <td><?php  echo $users->role; ?></td>
                     <td><?php  echo $users->taches; ?></td>
                     <td><?php  echo $users->nombre; ?></td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include RUTA_APP . '/vues/inc/footer.php'; ?>