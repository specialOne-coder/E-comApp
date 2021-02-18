
<?php

require_once('db/connexion_db.php');
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

	<title>enginnova</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
    <link rel="shortcut icon" href="" type="image/x-icon">
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
	<!-- HEADER -->
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
							<img src="./img/engi.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form method="get" action ="recherche.php">
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
								<strong class="text-uppercase">Mon Compte <i class="fa fa-caret-down"></i></strong>
							</div>
							<a href="connexion.php" class="text-uppercase">Login</a> / <a href="inscription.php" class="text-uppercase">Join</a>
							<ul class="custom-menu">
								<li><a href="client/index.php"><i class="fa fa-user-o"></i> Mon Compte</a></li>
								<li><a href="panier.php"><i class="fa fa-heart-o"></i> Mon panier</a></li>
								<li><a href="connexion.php"><i class="fa fa-unlock-alt"></i> Connexion</a></li>
								<li><a href="inscription.php"><i class="fa fa-user-plus"></i> Creer compte</a></li>
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a href="client/panierclient.php">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty">0</span>
								</div>
								<strong class="text-uppercase">Mon panier</strong>
								<br>
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
				<!-- category nav -->
				<div class="category-nav">
					<span class="category-header">Categories <i class="fa fa-list"></i></span>	
					<ul class="category-list">
						<li><a href="allcategories.php?category=business">Business</a></li>
						<li><a href="allcategories.php?category=design">design</a></li>
						<li><a href="allcategories.php?category=photographie">photographie</a></li>
						<li><a href="allcategories.php?category=developpement">Développement </a></li>
						<li> <a href="allcategories.php?category=marketing">marketing</a></li>
						<li><a href="allcategories.php?category=developpement personnel">developpement personnel</a></li>
						<li><a href="allcategories.php?category=informatiques et logiciels">informatiques et logiciels</a></li>
						<li><a href="allcategories.php">voir tous les categories</a></li>
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="index.php">Accueil</a></li>
						<li><a href="boutique.php">Boutique</a></li>
						<li> <a href="#">Enginnova</a>  </li>
						<li><a href="#">Ventes</a></li>
						<li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> Autres Pages <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="">Details sur les formations</a></li>
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

	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					<!-- banner -->
					<div class="banner banner-1">
						<img src="./img/learn.jpg" alt="">
						<div class="banner-caption">
							<h1 class="white-color">Des remises sur nos formations<br><span class="white-color font-weak">50%</span></h1>
							<button class="primary-btn">Acheter</button>
						</div>
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="./img/working-woman.jpg" alt="">
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="./img/divers.jpg" alt="">
						<div class="banner-caption">
							<h2 class="white-color">De nouvelles formations disponibles <span></span></h2>
							<a href="boutique.php"><button class="primary-btn">Consulter</button></a>
						</div>
					</div>
					<!-- /banner -->
				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
			
				<!-- Product Single -->

<?php
 if(isset($_GET['action'])){
   if($_GET['action'] == 'voirformation'){
	   $idrecupere = $_GET['id'];
	   $selectchoix = $bd->prepare("SELECT * FROM formation WHERE id = $idrecupere");
	   $selectchoix->execute();
	   while($donnebase = $selectchoix->fetch()){
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
								<img src="formation_images/<?php echo $donnebase ['titre'];?>" alt="">
							</div>
					    </div>
					</div>
					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<span class="sale">New</span>
							</div>
							<h2 class="product-name"><?php echo $donnebase ['titre']?></h2>
							<h3 class="product-price"><?php echo $donnebase ['prix']?> fcfa<del class="product-old-price"></del></h3>
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
								<button class="primary-btn add-to-cart" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
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
									<p><?php echo $donnebase ['description']?></p>
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
				
<?php
	  
    require_once('db/connexion_db.php');
    $selectf = $bd->prepare("SELECT * FROM formation ORDER BY id DESC");
    $selectf->execute();
    while($affichage = $selectf->fetch()){
?>
       <div class="col-md-3 col-sm-6 col-xs-6">
                 <div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>New</span>
									</div>
									<button class="main-btn quick-view"><i class="fa fa-search-plus"></i><a href="?action=voirformation&amp;id=<?php echo $affichage['id'];?>">voir les details</a></button>
									<img src="formation_images/<?php echo $affichage['titre'];?>"/>
								</div>
								<div class="product-body">
									<h3 class="product-price"><?php echo $affichage['prix'];?> <del class="product-old-price">fcfa</del></h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a href="#"><?php echo $affichage['titre'];?></a></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</div>
								</div>
							</div>
</div>
<!--------------------Modal--------------------------->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:blue;">Infos!!!</h4>
        </div>
        <div class="modal-body">
          <p>Connectez-vous d'abord avant d'ajouter la formation au panier</p>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
		<a href="connexion.php"><button type="button" class="btn btn-primary pull-left">se connecter</button> </a>
        </div>
      </div>
      
    </div>
  </div>
<?php
	}
	
?>
			</div>

		</div>		<!-- /Product Single -->
    </div>
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
							<li><a href="client/index.php">Mon compte</a></li>
							<li><a href="client/panierclient.php">Mon panier</a></li>
							<li><a href="#">Acheter</a></li>
							<li><a href="connexion.php">Connexion</a></li>
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

	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
