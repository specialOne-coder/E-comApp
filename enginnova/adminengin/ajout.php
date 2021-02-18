
<?php
  session_start();
  //header ("Content-type: image/jpeg");
  /**Si il y a une session continuer*/ 
  require_once('../db/connexion_db.php');
  if(isset($_SESSION['username'])){
?>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>  
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/ajout.css">  

       <!--Formulaire d'ajout ou modification d'un produit-->
       <div class="jumbotron text-center">
                 <h1>Enginnova</h1> 
                 <h3>Bienvenue <?php echo $_SESSION['username']; ?></h3>  
           <p>vous cherchez quelque chose?</p> 
               <form  method="get" class="form-inline">
                    <div class="input-group">
                    <input type="search" class="form-control" name="chercheformodordelete" size="50" placeholder="cherchez pour supprimer ou modifier" required>
                    <div class="input-group-btn">
                    <button type="button" name="recherche" class="btn btn-primary">Search</button>
                    <a href="../index.php"> <button type="button" name="recherche" class="btn btn-danger">Accueil</button></a>

                    </div>
                    </div>
               </form> <br><br><br>
<!---------------------------recherche------------------------------->
    <?php

if(isset($_GET['chercheformodordelete'])){
  $formationrecherche = htmlspecialchars($_GET['chercheformodordelete']);
  $selectformationrecherche = $bd->prepare("SELECT * FROM formation WHERE titre like '%".$formationrecherche."%' ORDER BY id DESC");
  $selectformationrecherche->execute();
  while($recherche = $selectformationrecherche->fetch()){
    echo'<h4>'.$recherche['titre'].'<h4>';
   ?>

   <div class="btnmodel">
    <button class="btn btn-warning"> <a href="?action=modifyformation&amp;id=<?php echo $recherche['id']; ?>">modifier</a> </button> 
    <button class="btn btn-danger" > <a href="?action=deleteformation&amp;id=<?php echo $recherche['id']; ?>">Supprimer</a> </button>  <br><br>
   </div>


  <?php
  }
}
    if(isset($_GET['action'])){ /*si il y a une action*/
      
/***********************************************Debut du traitement des formations***********************************/

       if($_GET['action'] == 'addformation'){ /*Si il appuit sur ajouter*/
      
       if(isset($_POST['submitaddform'])){
        
        /*recuperatiion des données du formulaire*/
        $titreform = htmlspecialchars($_POST['titre']);
        $categorieformation = htmlspecialchars($_POST['categorieform']);
        $descriptionformation = htmlspecialchars($_POST['descriptionform']);
        $prixformation = htmlspecialchars($_POST['prixform']);
        
        /*******Ajout de photo pour les formations *************/
        if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0){
                // Testons si l'extension est autorisée
            if ($_FILES['photo']['size'] <= 10000000){
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['photo']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees)) {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['photo']['tmp_name'], '../formation_images/' . basename($titreform));
                        echo '<div class="alert alert-success"><strong>l\'envoi de la photo a bien été effectué</strong></div> <br>'; 
                }else{
                    echo '<div class="alert alert-warning"><strong>Extention non-autorisee 
                    n\'entrez qu\' une image de type jpg</strong></div>';
                }
              }else {
            echo 'image trop grosse';
        }
        }elseif (isset($_FILES['photo']) AND $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE){
            echo '<div class="alert alert-warning"><strong>fichier inexistant</strong></div>';
        }

        /*****************************Ajout des contenus de la formation****************** */
        if (isset($_FILES['contenu']) AND $_FILES['contenu']['error'] == 0){
            // Testons si l'extension est autorisée
        if ($_FILES['contenu']['size'] <= 10000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['contenu']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('pdf');
            if (in_array($extension_upload, $extensions_autorisees)) {
                    // On peut valider le fichier et le stocker définitivement
                    move_uploaded_file($_FILES['contenu']['tmp_name'], '../contenu_formation/' . basename($titreform));
                    echo '<div class="alert alert-success"><strong>l\'envoi du contenu a bien été effectué</strong></div> <br>'; 
            }else{
                echo '<div class="alert alert-warning"><strong>Extention non-autorisee 
                n\'est autorisé que les fichiers de type pdf</strong></div>';
            }
          }else {
        echo 'Fichier trop gros';
    }
    }elseif (isset($_FILES['contenu']) AND $_FILES['contenu']['error'] == UPLOAD_ERR_NO_FILE){
        echo '<div class="alert alert-warning"><strong>fichier inexistant</strong></div>';
    }
    /******************************************Insertion *************************/ 

       if($titreform && $categorieformation && $descriptionformation && $prixformation){ /*si il a tout rempli*/

        try {
            $insertionformation = $bd->prepare("INSERT INTO formation(titre,description,categories,prix) 
            VALUES(?,?,?,?)"); 
            $insertionformation->execute(array(
              $titreform,$descriptionformation,$categorieformation,$prixformation
            )
            );
            echo'<div class ="alert alert-success"> Ajout de la formation réussie un autre? </div> <br>';
        } catch (\Throwable $th) {
            echo'<div class ="alert alert-danger"> Assurez vous que les champs correspondent </div>';
        }

       }else{
         echo'<div class ="alert alert-warning"> Veuillez remplir tous les champs en ajoutant aussi une image et reessayer  </div>';
       }
    }
    ?>
    <!-------------------------------Formulaire d'ajout---------------------------------->
 <div class="btnd">
    <h2>Ajouter une formation*</h2>
     <form action="" method="post" enctype= "multipart/form-data">
      <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de la formation" maxlength="25" required>
       <select name="categorieform" id="selectid">
       <?php
         $reqselcat = $bd->prepare("SELECT * FROM categories");
         $reqselcat->execute();
         while($values = $reqselcat->fetch()){
       ?>
         <option value="<?php echo $values['nom_categorie']; ?>"><?php echo $values['nom_categorie']; ?></option>
      <?php
         }
      ?>
       </select>
       <textarea class="form-control" id="descid" name="descriptionform" placeholder="Decrivez la formation" rows="5" required></textarea>
       <input type="number" name="prixform" id="prixid" class="form-control" placeholder="Prix de la formation" required>
       <label for="file">Image de la formation*</label>
       <input type="file" name="photo" required>
       <label for="file">Contenu de la formation* <h5>(PDF uniquement)</h5></label>
       <input type="file" name="contenu" required> 
       <button type="submit"   name="submitaddform" id="" class="btn btn-primary" value="" required> Ajouter la formation</button> <br><br><br>
     </form>
 </div>

<?php

  /*********************S'il appui sur modifier/supprimer************************/
  }else if($_GET['action'] == 'modifyanddeleteformation'){
      
      $updatedelete = $bd->prepare("SELECT * FROM formation ORDER BY id DESC");
      $updatedelete->execute();

     while($do = $updatedelete->fetch()){
        echo'<h4>'.$do['titre'].'<h4>';
     ?>

    <div class="btnmodel">
     <button class="btn btn-warning"> <a href="?action=modifyformation&amp;id=<?php echo $do['id']; ?>">modifier</a> </button> 
     <button class="btn btn-danger" > <a href="?action=deleteformation&amp;id=<?php echo $do['id']; ?>">Supprimer</a> </button>  <br><br>
    </div>

   <?php
     }
  }else if($_GET['action'] == 'modifyformation'){
     $idd = $_GET['id'];
     $selforupdateanddelete = $bd->prepare("SELECT * FROM formation WHERE id = $idd");
     $selforupdateanddelete->execute();
     while($res = $selforupdateanddelete->fetch()){
  ?>
      
            <!-------------------------------Formulaire de la modification---------------------------------->
    <div class="btnd">
    <h2>Modifier la formation*</h2>
     <form action="" method="post" enctype= "multipart/form-data">
      <input type="text" name="titrem" id="" class="form-control" placeholder=" nouveau titre de la formation" value="<?php echo $res['titre']  ?>" maxlength="25"  required>
      <select name="categoriem" id="selectid" required>
       <option value="<?php echo $res['categories']?>"><?php echo $res['categories'] ?> </option>
       <?php
         $reqselcat = $bd->prepare("SELECT * FROM categories");
         $reqselcat->execute();
         while($values = $reqselcat->fetch()){
       ?>
         <option value="<?php echo $values['nom_categorie']; ?>"><?php echo $values['nom_categorie']; ?></option>
      <?php
         }
      ?>
      </select>
       <textarea class="form-control" id="descid" name="descriptionm" placeholder="redecrivez la formation" rows="5" value = "<?php echo $res['description']?>"required><?php echo $res['description']?></textarea>
       <input type="number" name="prixm" id="prixid" class="form-control" placeholder="nouveau prix de la formation" value = "<?php echo $res['prix']?>"required>
       <label for="file">Image de la formation*</label>
       <input type="file" name="photomod" required>
       <label for="file">Contenu de la formation* <h5>(PDF uniquement)</h5></label>
       <input type="file" name="contenumod" required> 
       <button type="submit" name="submitmodformation" id="" class="btn btn-primary" value=""> modifier la formation </button> <br><br><br><br><br>

   </form> 

   <?php
     }
     if(isset($_POST['submitmodformation'])){  
        $newtitre = $_POST['titrem'];
        $newcategorie = $_POST['categoriem'];
        $newdescription = $_POST['descriptionm'];
        $newprix = $_POST['prixm'];

        /**********Modification de photo pour les formations *************/
        if (isset($_FILES['photomod']) AND $_FILES['photomod']['error'] == 0){
          // Testons si l'extension est autorisée
      if ($_FILES['photomod']['size'] <= 10000000){
          // Testons si l'extension est autorisée
          $infosfichier = pathinfo($_FILES['photomod']['name']);
          $extension_upload = $infosfichier['extension'];
          $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
          if (in_array($extension_upload, $extensions_autorisees)) {
                  // On peut valider le fichier et le stocker définitivement
                  move_uploaded_file($_FILES['photomod']['tmp_name'], '../formation_images/' . basename($newtitre));
                  echo '<div class="alert alert-success"><strong>l\'envoi de la photo a bien été effectué</strong></div>'; 
          }else{
              echo '<div class="alert alert-warning"><strong>Extention non-autorisee 
              n\'entrez qu\' une image de type jpg</strong></div>';
          }
        }else {
      echo 'image trop grosse';
       }
  }elseif (isset($_FILES['photo']) AND $_FILES['photomod']['error'] == UPLOAD_ERR_NO_FILE){
      echo '<div class="alert alert-warning"><strong>fichier inexistant</strong></div>';
  }
/**************************************************************************************************/
 if (isset($_FILES['contenumod']) AND $_FILES['contenumod']['error'] == 0){
  // Testons si l'extension est autorisée
if ($_FILES['contenumod']['size'] <= 10000000){
  // Testons si l'extension est autorisée
  $infosfichier = pathinfo($_FILES['contenumod']['name']);
  $extension_upload = $infosfichier['extension'];
  $extensions_autorisees = array('pdf');
  if (in_array($extension_upload, $extensions_autorisees)) {
          // On peut valider le fichier et le stocker définitivement
          move_uploaded_file($_FILES['contenumod']['tmp_name'], '../contenu_formation/' . basename($newtitre));
          echo '<div class="alert alert-success"><strong>l\'envoi du contenu a bien été effectué</strong></div>'; 
  }else{
      echo '<div class="alert alert-warning"><strong>Extention non-autorisee 
      n\'est autorisé que les fichiers de type pdf</strong></div>';
  }
}else {
echo 'Fichier trop gros';
}
}elseif (isset($_FILES['contenumod']) AND $_FILES['contenumod']['error'] == UPLOAD_ERR_NO_FILE){
echo '<div class="alert alert-warning"><strong>fichier inexistant</strong></div>';
}
/********************/
         $update = $bd->prepare("UPDATE formation SET titre = ?, description = ?,categories = ?,prix = ? WHERE id =$idd ");
         $update->execute(array(
           $newtitre,$newdescription,$newcategorie,$newprix
         ));
         header('location:ajout.php?action=modifyanddeleteformation');
     }
  }

   else if($_GET['action'] == 'deleteformation'){
        $id =$_GET['id'];
        $deleteformation = $bd->prepare("DELETE FROM formation WHERE id =$id");
        $deleteformation->execute(); 
        echo'<div class="alert alert-success"> Supppression réussie </div>';
        header('location:ajout.php?action=modifyanddeleteformation');
      }










/*******************fin traitement du lien formation et debut du traitement des categories************/


            if($_GET['action'] == 'addcategorie'){ 
                if(isset($_POST['submitaddcat'])){
                    $nomcategorie = $_POST['nomcate'];
                    if($nomcategorie){
                        $insertioncat = $bd->prepare("INSERT INTO categories(nom_categorie) VALUES ('$nomcategorie')");
                        $insertioncat->execute();
                        echo'<div class="alert alert-success"> Ajout de la categorie réussie </div>';
                    }else {
                        echo'<div class ="alert alert-warning">Remplissez tous les champs et reessayer</div>';
                    }
                }
             ?>

  <div class="btnd">
    <h2>Ajouter une categorie*</h2>
     <form action="" method="post">
      <input type="text" name="nomcate" id="" class="form-control" placeholder="nom de la categorie" required>
       <button type="submit"   name="submitaddcat" id="" class="btn btn-warning" value=""> Ajouter la categorie</button> <br><br><br>
   </form>
   
   </div>

      <?php
            }else if($_GET['action'] == 'modifyanddeletecategorie'){
                echo'<h2>Modifier ou supprimer une categorie*</h2>';
                $selectioncat = $bd->prepare("SELECT * FROM categories ORDER BY id DESC");
                $selectioncat->execute();
                while($categorieselectione = $selectioncat->fetch()){
                    echo '<h3>'.$categorieselectione['nom_categorie'].'<h3>';
     ?>
    <div class="btnmodel">
      <button class="btn btn-warning"> <a href="?action=modifycategorie&amp;id=<?php echo $categorieselectione['id']; ?>">modifier</a> </button> 
      <button class="btn btn-danger" > <a href="?action=deletecategorie&amp;id=<?php echo $categorieselectione['id']; ?>">Supprimer</a> </button>  <br><br>
    </div>

     <?php
       }
            }else if($_GET['action'] == 'modifycategorie'){

                 $idcatmod = $_GET['id'];
                 $selectidcat = $bd->prepare("SELECT * FROM categories WHERE id = $idcatmod ");
                 $selectidcat->execute();
                 while($donnecat = $selectidcat->fetch()){         
     ?>
                 <form action="" method="post">
                 <input type="text" name="nomcatemod" id="" class="form-control" value="<?php echo $donnecat['nom_categorie']; ?>" required> <br><br>
                 <button type="submit"   name="submitmodcat" id="" class="btn btn-warning" value=""> modifier la categorie</button> <br><br><br>
                 </form>

     <?php
                 }
                 if(isset($_POST['submitmodcat'])){
                     $nommodify = $_POST['nomcatemod'];
                     $modifcategorie = $bd->prepare("UPDATE categories set nom_categorie = ? WHERE id = $idcatmod ");
                     $modifcategorie->execute(array(
                      $nommodify
                     ));
                     header('location:ajout.php?action=modifyanddeletecategorie');
                 }
            }else if($_GET['action'] == 'deletecategorie'){
                $idcatdel = $_GET['id'];
                $deletecat = $bd->prepare("DELETE FROM categories WHERE id = $idcatdel");
                $deletecat->execute();
                header('location:ajout.php?action=modifyanddeletecategorie');
            }









/**********************************Fin du traitement de la categorie et debut de celle de l'user**************************/
         if($_GET['action'] == 'adduser'){
             if(isset($_POST['submitadduser'])){
                $nameuser = $_POST['nomadmin'];
                $passuser = $_POST['passadmin'];
                 if($nameuser && $passuser){
                 $inseruser = $bd->prepare("INSERT INTO administrateur(nom,passadmin) VALUES(?,?)");
                 $inseruser->execute(array(
                  $nameuser,$passuser
                 ));
                 echo'<div class="alert alert-success"> Ajout de l\'administrateur réussie </div>';
                 }else{
                    echo'<div class="alert alert-warning"> remplissez tous les champs et reessayer </div>';
                 }
             }
     ?>
       <div class="btnd"> 
          <h2>Ajouter un administrateur comme vous*</h2>
            <form action="" method="post">
                <input type="text" name="nomadmin" id="" class="form-control" placeholder="Nom d'utilisateur" required>
                <input type="password" name="passadmin" id="" class="form-control" placeholder="Mot de passe" required>
                <button type="submit"   name="submitadduser" id="" class="btn btn-success" value=""> Ajouter l'utilisateur</button> <br><br><br>
           </form>
   
      </div>
      <?php
         }else if($_GET['action'] == 'modifyanddeleteuser'){
            echo'<h2>Modifier ou supprimer un administrateur*</h2>';
             $selectuser = $bd->prepare("SELECT * FROM administrateur");
             $selectuser->execute();
             while($donneuser = $selectuser->fetch()){
                 echo'<h3>'.$donneuser['nom'].'<h3>';
      ?>
    <div class="btnmodel">
        <button class="btn btn-warning"> <a href="?action=modifyuser&amp;id=<?php echo $donneuser['id']; ?>">modifier</a> </button> 
        <button class="btn btn-danger" > <a href="?action=deleteuser&amp;id=<?php echo $donneuser['id']; ?>">Supprimer</a> </button>  <br><br>
    </div>

      <?php
             }
         }else if($_GET['action'] == 'modifyuser'){
            echo'<h2>Modifier un administrateur*</h2>';
             $iduser = $_GET['id'];
             $selectusermodify = $bd->prepare(" SELECT * FROM administrateur WHERE id = $iduser ");
             $selectusermodify->execute();
             while($donneuserselect = $selectusermodify->fetch()){
      ?>
           <form action="" method="post">
                <input type="text" name="newname" id="" class="form-control" value="<?php echo $donneuserselect['nom']; ?>"required>
                <input type="text" name="newpass" id="" class="form-control" value="<?php echo $donneuserselect['passadmin']; ?>"required> <br><br>
                <button type="submit"   name="submitmoduser" id="" class="btn btn-success" value=""> Modifier l'administrateur</button> <br><br><br>
           </form> 
      <?php
         }
         if(isset($_POST['submitmoduser'])){
             $newnom = $_POST['newname'];
             $newpass = $_POST['newpass'];
             if($newnom && $newpass){
             $updateuser = $bd->prepare("UPDATE administrateur set nom = ? , passadmin = ? WHERE id = $iduser");
             $updateuser->execute(array(
              $newnom,$newpass
             ));
             echo'<div class="alert alert-success"> Modification reussie </div>';
             header('location:ajout.php?action=modifyanddeleteuser');
             }else{
                 echo'<div class="alert alert-warning"> remplissez tous les champs et reessayer </div>';
             }
         }
         
         }else if($_GET['action'] == 'deleteuser'){
             $iduserdel = $_GET['id'];
             $deleteuser = $bd->prepare("DELETE FROM administrateur WHERE id = $iduserdel");
             $deleteuser->execute();
             header('location:ajout.php?action=modifyanddeleteuser');
         }
 
}
     
      ?>

      <!----------------------button d'ajout et de modification/supprimer-------------->

      <a href="?action=addformation"><button class="button"><span>Ajouter une formation</span></button></a>
      <a href="?action=modifyanddeleteformation"><button class="button"><span>Modifier/Supprimer</span></button></a> <br> <br> <br>
      <a href="?action=addcategorie"><button class="buttoncat"><span>Ajouter une categorie</span></button></a>
      <a href="?action=modifyanddeletecategorie"><button class="buttoncat"><span>Modifier/Supprimer</span></button></a> <br> <br> <br>
      <a href="?action=adduser"><button class="buttonuser"><span>Ajouter un utilisateur</span></button></a>
      <a href="?action=modifyanddeleteuser"> <button class="buttonuser"><span>Modifier/Supprimer</span></button></a>

</div>


   
</body>
</html> 



<?php

}else{
  header('location: index.php');
}

?>




