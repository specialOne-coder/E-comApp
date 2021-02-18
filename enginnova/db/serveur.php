
<?php

require_once("connexion_db.php");

if(isset($_POST['inscription'])){
    $nom = $_POST['nom'];
    $num = $_POST['num'];
    $pass = $_POST['pass'];
    $confirm = $_POST['conf'];

    
    if($nom && $num && $pass && $confirm){
    
          if($pass == $confirm){
             
                $passwordhach = password_hash($pass,PASSWORD_DEFAULT);
                $insertion= $bd->prepare("INSERT INTO client(nom,numero,pass) VALUES('$nom','$num','$pass')");
                $insertion->execute();
                echo"<div class='alert alert-success'> Inscription reussie </div>";
              }else{
                    echo"<div class='alert alert-warning'> les mots de passe ne sont pas les memes </div>";
              }
    }else{
        echo"<div class='alert alert-warning'> Remplissez tous les colonnes et réessayer </div>";
    }
    
}

if(isset($_POST['connexion'])){
    
    $nomconnexion = $_POST['nomcx'];
    $passconnexion = $_POST['passcx'];

    $selection = $bd->prepare("SELECT * FROM user");
    $selection->execute();

    while($donne = $selection->fetch()){
       if($nomconnexion == $donne['nom'] && $passconnexion == $donne['pass']){
          header('Location: ../index.php');
          
       }         
    }
   
    echo'<div class="alert alert-danger> Identifiant ou mot de passe erroné </div>"';


}








?>