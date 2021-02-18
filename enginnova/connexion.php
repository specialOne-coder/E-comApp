
<?php
    ob_start();
    session_start();
    require_once("entete.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

   <!-- nouislider -->
   <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

   <!-- Font Awesome Icon -->
   <link rel="stylesheet" href="css/font-awesome.min.css">

   <!-- Custom stlylesheet -->
   <link type="text/css" rel="stylesheet" href="css/style.css" />

</head>
<body>
            
             
      <div class="containercon">
           <div class="buttonc">
              <button class="btn"><i class="fa fa-google"></i>  Se connecter avec Google</button>
           </div>
            
           <div class="panel panel-body">
           </div>

           <div class="formconnexion">
              <form action="" method="post">
                 <input type="text" name="username" id="nomcon" class="form-control"  placeholder="Nom d'utilisateur" required> <br><br>
                 <input type="password" name="userpassword" id="passcon"   class="form-control" placeholder="mot de passe" required> <br>
                 <a href="">mot de passe oublié? </a><br> <br>
                 <div class="buttoncon">
                     <button class="btn btn-primary" name="btncon" ><b>se connecter</b></button>
                 </div> 
              </form>
           </div> <br><br><br>
           
           <a href="inscription.php"> <b> Vous n'avez pas de compte ? Inscrivez-vous ! </b> </a> <br>

           <div id="messagec">
    
        
    <?php

        if(isset($_POST['btncon'])){

          $nomconnexion = $_POST['username'];
          $passconnexion = $_POST['userpassword'];
  
          $selection = $bd->prepare("SELECT * FROM client");
          $selection->execute();
  
          while($donne = $selection->fetch()){
             if($nomconnexion == $donne['nom'] && $passconnexion == $donne['pass']){
                $_SESSION['clientname'] = $nomconnexion;
                $_SESSION['clientpassword'] = $passconnexion;
                header('location: client/index.php');
             }         
          }
         
          echo'<div class="alert alert-danger"> Identifiant ou mot de passe erroné </div>';


        }
     ?>



           </div>


   </div>


    
      <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>


<?php
    echo'</br></br></br></br></br></br>';
    require_once("footer.php");
    ob_end_flush();
 
?>