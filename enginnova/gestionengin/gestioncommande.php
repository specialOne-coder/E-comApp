
<?php
  session_start();
  /**Si il y a une session continuer*/ 
  require_once('../db/connexion_db.php');
  if(isset($_SESSION['username'])){
?>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/ajout.css">  

       <!--Formulaire d'ajout ou modification d'un produit-->
       <div class="jumbotron text-center">
                 <h1>Enginnova</h1> 
                 <h3>Bienvenue gestionnaire <?php echo $_SESSION['username']; ?></h3>  
           <p>vous cherchez quelque chose?</p> 
               <form  method="get" class="form-inline">
                    <div class="input-group">
                    <input type="search" class="form-control" name="cherchecommande" size="50" placeholder="recherche non fonctionnelle" required>
                    <div class="input-group-btn">
                    <button type="button" name="recherche" class="btn btn-primary">Search</button>
                    <a href="../index.php"> <button type="button" name="recherche" class="btn btn-danger">Accueil</button></a>
                    </div>
                    </div>
               </form> <br><br><br>
             <?php
             
             if(isset($_GET['action'])){
                 if($_GET['action'] == 'validercommande'){
               
                 $selectcommande = $bd->prepare("SELECT * FROM commande ORDER BY id_commande DESC");
                 $selectcommande->execute();
                 while($commande = $selectcommande->fetch()){
                       $idcommande = $commande['id_commande'];
                       $idcommandeformation = $commande['id_formationc'];
                       $idcommandeclient = $commande['id_clientc'];
                         $selectclient = $bd->prepare("SELECT * FROM client WHERE id = '$idcommandeclient' ");
                         $selectclient->execute();
                          while($clientconcerne = $selectclient->fetch()){
                               $nomclient = $clientconcerne['nom'];
                               $numeroclient = $clientconcerne['numero'];
                               $selectformation = $bd->prepare("SELECT * FROM formation WHERE id = '$idcommandeformation'");
                                $selectformation->execute(); 
                                  while($formationachete = $selectformation->fetch()){
                                     $formationbuy = $formationachete['titre'];
                                     $prixformation = $formationachete['prix'];
                                     /*stockage dans les session*/
                         
            ?>
                   <div class="panel panel-info" style="width:50%; margin:auto;">
                        <div class="panel-heading"> <h3>Commande </h3></div>
                        <div class="panel-body">
                           <p><b>Nom du client : <?php echo $nomclient; ?></b></p>
                           <P><b>Numero du client : <?php echo $numeroclient; ?></b></P>
                           <p><b>Formation commandée : <?php echo $formationbuy; ?></b></p>
                           <p><b>Prix de la formation : <?php echo $prixformation; ?> fcfa</b></p>
                        </div>
                        <div class="panel-footer">
                         <button type="submit" class="btn btn-primary" name="valider" data-toggle="modal" data-target="#myModal">Valider</button>
                        </div>
                    </div> <br><br>

               <?php       
                    }
                 }  
                              }
                          }

                 }
             ?>
        
    
        <button class="button"><span><a href="?action=validercommande">Consulter et Valider les commandes</a></span></button>
        </div>
       

<!--------------------Modal--------------------------->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:blue;">Good</h4>
        </div>
        <div class="modal-body">
          <p>Commande validée avec success</p>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
      
    </div>
  </div>

  <?php
  }
?>
