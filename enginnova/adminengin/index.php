<?php

session_start();
    echo'<br><br><br><br><br><br><br><br>';
    require_once("../db/connexion_db.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>  
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <title>Document</title>
</head>


<body>


        <div class="containercon">
           <div class="buttonc">
              <button class="btn"><i class="fa fa-google"></i>  Administrateur </button>
           </div>
            
           <div class="panel panel-body">
           </div>

           <div class="formconnexion">
              <form  method="post">
                 <input type="text" name="username" id="nomcon" class="form-control" placeholder="Nom d'utilisateur" required> <br><br>
                 <input type="password" name="passw" id="passcon" class="form-control" placeholder="mot de passe" required> <br>
                 <a href="">mot de passe oublié? </a><br> <br>
                 <div class="buttoncon">
                     <button class="btn btn-primary" name="btnconadmin" ><b>se connecter</b></button>
                 </div> 
              </form>
           </div> <br><br><br>
           
           <a href="inscription.php"> <b> Vous n'avez pas de compte ? Demandez en un </b> </a> <br>

           <div id="messagec">
                
   <?php

    if(isset($_POST['btnconadmin'])){
 
     $use = $_POST['username'];
     $pax = $_POST['passw'];
     $requete = $bd->prepare("SELECT * FROM administrateur");
     $requete->execute();
     while($reponse = $requete->fetch()){
            if($use == $reponse['nom'] && $pax == $reponse['passadmin']){
              $_SESSION['username'] = $use;
              $_SESSION['password'] = $pax;
              header('location:ajout.php');
            }else{
                
            }
         }
         echo' <div class="alert alert-danger">Identifiant ou mot de passe incorrect </div>';
     }

 ?>
        
           </div>

     </div>     

</body>
</html>


