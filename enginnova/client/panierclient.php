<?php
 
session_start();
if(isset($_SESSION['clientname'])){
require_once('../db/connexion_db.php');
$select = $bd->prepare("SELECT * FROM categories");
$select->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Espace client</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../css/slick.css" />
	<link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../css/style.css" />


</head>

<body>
<header>
		<!-- top Header -->

		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="#">
							<img src="../img/engi.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form method="get" action="rechercheclient.php">
							<input class="input search-input" type="text" name="formationrecherche" placeholder="Entrer ce que vous chercher" required>
							<select class="input search-categories">
							<?php
                                 while($values = $select->fetch()){
                             ?>
                              <option value="<?php echo $values['nom_categorie']; ?>"><?php echo $values['nom_categorie']; ?></option>
                            <?php
                             }
                            ?>
							</select>
							<button class="search-btn" name="searchbtn"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase"><?php echo$_SESSION['clientname']?> <i class="fa fa-caret-down"></i></strong>
							</div>
							<ul class="custom-menu">
								<li><a href="index.php"><i class="fa fa-user-o"></i> Mon Compte</a></li>
								<li><a href=""><i class="fa fa-heart-o"></i> Mon panier</a></li>
								<li><a href="deconnexion.php"><i class="fa fa-unlock-alt"></i>Deconnexion</a></li>
							</ul>
						</li>
						<!-- /Account -->
						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a hreh="">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<?php
									$nomclientforpanier = $_SESSION['clientname'];
									$selectmonpanier = $bd->prepare("SELECT * FROM client WHERE nom = '$nomclientforpanier'");
									$selectmonpanier->execute();
									while($cp = $selectmonpanier->fetch()){
										$idclientforpanier = $cp['id'];
										$selectnbre = $bd->prepare("SELECT COUNT(id) AS nbretotal FROM panier WHERE id_client = '$idclientforpanier'");
										$selectnbre->execute();
										while($nbre = $selectnbre->fetch()){
									?>
									<span class="qty"><?php echo $nbre['nbretotal'];?></span>
									<?php
									}
								       }
									?>
								</div>
								<strong class="text-uppercase">Mon panier</strong>
								<span></span>
							</a>
	
						</li>
						<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
    <!-- /HEADER -->
				<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="index.php">Accueil</a></li>
						<li><a href="boutiqueclient.php">Boutique</a></li>
						<li> <a href="#">Enginnova</a>  </li>
						<li><a href="#">Ventes</a></li>
						<li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> Autres Pages <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="product-page.html">Details sur les formations</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
    <!-- /NAVIGATION -->

    <?php
        if(isset($_GET['action'])){
            if($_GET['action'] == 'commander'){
                $idformationpourlacommande = $_GET['id'];
                $clientname = $_SESSION['clientname'];
                $selectclientinfos = $bd->prepare("SELECT * FROM client WHERE nom = '$clientname'");
                $selectclientinfos->execute();
                while($infos = $selectclientinfos->fetch()){
                    $idduclientenquestion = $infos['id'];
                    $envoidelacommande = $bd->prepare("INSERT INTO commande(id_formationc,id_clientc) VALUES(?,?)");
                    $envoidelacommande->execute(array(
                       $idformationpourlacommande,$idduclientenquestion
                    ));
                }
    ?><br><br><br>
   <h2><p class="text-center">Vous venez de commander <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style=""><i class="fa fa-check-square-o">Confirmez la commande</i></button></p></h2>
   
    <?php
            }else if($_GET['action'] == 'supprimerdupanier'){
				  $idasup = $_GET['id'];
				  $delete = $bd->prepare("DELETE FROM panier WHERE id_formation = $idasup");
				  $delete->execute();
			}
        }
    ?>

    <!--------------------------phpdupanier--------------------------------->
    <?php
					$nomclientforpanier = $_SESSION['clientname'];
							$selectmonpanier = $bd->prepare("SELECT * FROM client WHERE nom = '$nomclientforpanier'");
							$selectmonpanier->execute();
							while($cp = $selectmonpanier->fetch()){
								$idclientforpanier = $cp['id'];
							$selectpanierduclient = $bd->prepare("SELECT * FROM panier WHERE id_client = '$idclientforpanier'  ORDER BY id DESC");
							$selectpanierduclient->execute();
							while($monpanier = $selectpanierduclient->fetch()){
								  $idformattiondupanier = $monpanier['id_formation'];
									 $selectformation = $bd->prepare("SELECT * FROM formation WHERE id = '$idformattiondupanier'");
									 $selectformation->execute();
									 while($lesformationdupanier = $selectformation->fetch()){
                                        
   ?>
                           <div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view">
							<div class="product-view">
								<img src="../formation_images/<?php echo $lesformationdupanier['titre'];?>" alt="">
							</div>
					    </div>
					</div>
					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<span class="sale">New</span>
							</div>
							<h2 class="product-name"><?php echo $lesformationdupanier['titre']?></h2>
							<h3 class="product-price"><?php echo $lesformationdupanier['prix']?> fcfa<del class="product-old-price"></del></h3>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
							</div>
							<p><strong>Mise en vente par:</strong> Enginnova</p>
							<p>Cette formation a été mise en vente par enginnova et est deja disponible sur d'autres plateformes .
								 elle a été  consulter plusieurs fois et fut l'une des meilleures formations selon les clients. 
								 Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, error animi sint adipisci ex
								  officiis eaque ut accusantium consecteturporro sapiente soluta quae voluptas modi necessitatibus 
								  assumenda magnam nihil pariatur?  Lorem ipsum dolor sit amet consectetur adipisicing elit. 
								  Neque, odit debitis expedita libero eaque ipsam in dolores asperiores vel iusto?
								   Ratione eum repellat corporis minus, magnam sed excepturi quibusdam sapiente.</p>
							<div class="product-btns">
								<!--
								<div class="qty-input"> 
									<span class="text-uppercase">QTY: </span>
									<input class="input" type="number">
								</div>-->
								<a href="?action=commander&amp;id=<?php echo $lesformationdupanier['id'];?>"><button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Commander </button> </a>
								<a href="?action=supprimerdupanier&amp;id=<?php echo $lesformationdupanier['id'];?>"><button class="primary-btn add-to-cart"><i class="fa fa-trash"></i> Supprimer </button> </a>
								
								<div class="pull-right">
									<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p><?php echo $lesformationdupanier['description']?></p>
								</div>
								
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>

   <?php
                                    
                                    }
                                }
                            }
    ?>









	<!-- FOOTER -->
	<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
		            <p > <h1 style="color: rgb(74, 155, 248) ;">Enginnova</h1> </p>
		          </a>
						</div>
						<!-- /footer logo -->

						<p>Faites nous confiance, n'hesitez pas a vous faire former par enginnova, nous proposons des formations de très grande renommé</p>

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Mon compte</h3>
						<ul class="list-links">
							<li><a href="#">Mon compte</a></li>
							<li><a href="#">Mon panier</a></li>
							<li><a href="#">Acheter</a></li>
							<li><a href="#">Connexion</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Nos Service</h3>
						<ul class="list-links">
							<li><a href="#">A propos</a></li>
							<li><a href="#">Conditions de retour</a></li>
							<li><a href="#">Guide d'achat</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Contactez-nous</h3>
						<p>Ecrivez nous pour nous faire part de vos suggestions et autres chose =s bien plus interessante</p>
						<form>
							<div class="form-group">
								<input class="input" placeholder="Enter Email Address"> <br>
								<textarea name="" id="" cols="30" rows="5" class="form-control" style="margin-top: 10px;" placeholder="votre message"></textarea>
							</div>
							<button class="primary-btn">Envoyer</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This site is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">ferdinand Attivi</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
    <!-- /FOOTER -->
    <!--------------------Modal--------------------------->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:green;">Success</h4>
        </div>
        <div class="modal-body">
          <p>Vous venez de confirmer la commande,Des mentors vous contacteront par mail pour le bon déroulement de la formation</p>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-success" data-dismiss="modal">Fermer</button>
		<a href="http://gmail.com"><button type="button" class="btn btn-success pull-left">voir mes mails</button> </a>
        </div>
      </div>
      
    </div>
  </div>

	<!-- jQuery Plugins -->
    <script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>
</body>

</html>

<?php

}else{
	header('location:../connexion.php');
}
?>