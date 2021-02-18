
<?php
   ob_start();
   require_once("entete.php"); 
   require_once('db/connexion_db.php');
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
              <button class="btn"><i class="fa fa-google"></i>  S'inscrire avec Google</button>
           </div>
            
           <div class="panel panel-body">
           </div>

           <div class="formconnexion">
             <form action="" method="post">
                 <input type="text" name="username" id="nomuser" class="form-control" minlength="4" placeholder="Nom d'utilisateur" required> <br><br>
                 <input type="number" name="usertel" id="numerouser" class="form-control" minlength="8" placeholder="Numéro de télelephone" required> <br><br>
                 <input type="password" name="userpassword" id="motuser" class="form-control" minlength="6" placeholder="Mot de passe"required> <br><br>
                 <input type="password" name="userpasswordconfirm" minlength="6" id="confirmuser" class="form-control" placeholder="Confirmez le mot de passe" required> <br>
                 <div class="buttoncon">
                     <button class="btn btn-primary" id="save" name="inscription"><b>s'inscrire</b></button>
                 </div> 
             </form>
           </div> <br><br><br>
           
           <a href="connexion.php"> <b> Vous avez déja un compte ? Connectez-vous ! </b> </a> <br> <br><br>

           <div id="message">
           
           <?php
               if(isset($_POST['inscription'])){
                  $nameinscription = $_POST['username'];
                  $numinscription = $_POST['usertel'];
                  $passwordinscription = $_POST['userpassword'];
                  $passwordconfirminscription = $_POST['userpasswordconfirm'];

                  if($passwordinscription == $passwordconfirminscription){
                    $inscription = $bd->prepare("INSERT INTO client(nom,numero,pass) VALUES(?,?,?)");
                    $inscription->execute(array(
                    $nameinscription,$numinscription,$passwordinscription
                  ));
                  /*echo'<div class = "alert alert-success">inscription reussie  
                  <a href="connexion.php"><b>connectez-vous</b></a></div>';*/
                  header('location:connexion.php');
                  }else{
                      echo'<div class = "alert alert-warning">les mots de passe ne sont pas les memes reessayer</div>';
                  }
               }

           ?>

           </div>
      </div>  <br><br><br><br><br>

  <!--     <script>
           
           $(document).ready(function(){
              $("#save").click(function(){
                  var nom = $("#nomuser").val();
                  var num = $("#numerouser").val();
                  var motp = $("#motuser").val();
                  var confirm = $("#confirmuser").val();
                  
                  $.ajax({
                      url:"db/serveur.php",
                      type:"post",
                      async:false,
                      data: {
                          "inscription":1,
                          "nom":nom,
                          "num":num,
                          "pass":motp,
                          "conf":confirm
                      },

                      success:function(data){
                      $("#nomuser").val('');
                      $("#numerouser").val('');
                      $("#motuser").val('');
                      $("#confirmuser").val('');
                      $("#message").html(data);
                    }

                  });

              });
                
           });

       </script>  -->

<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php
   echo'</br></br></br></br>';
   require_once("footer.php");
   ob_end_flush();
?>