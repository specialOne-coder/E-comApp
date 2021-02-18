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
								<li><a href="panierclient.php"><i class="fa fa-heart-o"></i> Mon panier</a></li>
								<li><a href="deconnexion.php"><i class="fa fa-unlock-alt"></i>Deconnexion</a></li>
							</ul>
						</li>
						<!-- /Account -->
						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a href="panierclient.php">
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
				<!-- category nav -->
				<div class="category-nav">
					<span class="category-header">Categories <i class="fa fa-list"></i></span>	
					<ul class="category-list">
						<li><a href="allcategoriesclient.php?category=business">Business</a></li>
						<li><a href="allcategoriesclient.php?category=design">design</a></li>
						<li><a href="allcategoriesclient.php?category=photographie">photographie</a></li>
						<li><a href="allcategoriesclient.php?category=developpement">Développement </a></li>
						<li> <a href="allcategoriesclient.php?category=marketing">marketing</a></li>
						<li><a href="allcategoriesclient.php?category=developpement personnel">developpement personnel</a></li>
						<li><a href="allcategoriesclient.php?category=informatiques et logiciels">informatiques et logiciels</a></li>
						<li><a href="allcategoriesclient.php">voir tous les categories</a></li>
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="#">Accueil</a></li>
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
						<img src="../img/welcome.jpg" alt="">
						<div class="banner-caption">
							<h2 class="primary-color"><br><span class="white-color font-weak"></span></h2>
						</div>
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="../img/ach.jpg" alt="">
						
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="../img/divers.jpg" alt="">
						<div class="banner-caption">
							<h2 class="white-color">De nouvelles formations disponibles <span></span></h2>
							<a href="boutiqueclient.php"><button class="primary-btn">Consulter</button></a>
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
								<img src="../formation_images/<?php echo $donnebase ['titre'];?>" alt="">
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
								<a href="?action=ajoutaupanier&amp;id=<?php echo $donnebase['id'];?>"><button class="primary-btn add-to-cart" onclick=alertpanier()><i class="fa fa-shopping-cart"></i> Ajouter au panier</button></a>
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
<!----------------------------Affichage des produits---------------------------->
<?php
    require_once('../db/connexion_db.php');
    $selectf = $bd->prepare("SELECT * FROM formation ORDER BY id desc");
    $selectf->execute();
    while($affichage = $selectf->fetch()){
?>
        <div class="col-md-3 col-sm-6 col-xs-6">
                 <div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>New</span>
									</div>
									<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> <a href="?action=voirformation&amp;id=<?php echo $affichage['id'];?>">voir les details</a> </button>
									<img src="../formation_images/<?php echo $affichage['titre'];?>"/>
								</div>
								<div class="product-body">
									<h3 class="product-price"> <?php echo $affichage['prix'];?> fcfa <del class="product-old-price"></del></h3>
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
										<a href="?action=ajoutaupanier&amp;id=<?php echo $affichage['id'];?>"><button class="primary-btn add-to-cart" name="insertpanier" data-toggle="modal" data-target="#myModal" onclick= alertpanier()><i class="fa fa-shopping-cart">Add to cart</i></button></a>
									</div>
								</div>
							</div>
</div>
<!--------------------Modal--------------------------->

<?php 
	}
	if(isset($_GET['action'])){
		if($_GET['action'] == 'ajoutaupanier'){
		$idformation = $_GET['id'];
		 $clientnom = $_SESSION['clientname'];
		 $selectclient = $bd->prepare("SELECT * FROM client WHERE nom = '$clientnom'");
		 $selectclient->execute();
		 while($lesclients = $selectclient->fetch()){
			 $idclient = $lesclients['id'];
			 $insertiondanslepanier = $bd->prepare("INSERT INTO panier(id_client,id_formation) VALUES(?,?)");
			 $insertiondanslepanier->execute(array(
				 $idclient,$idformation
			 ));
		 }
	  }
	}
?>
			</div>

		</div>		<!-- /Product Single -->
    </div>


    <script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/monjs.js"></script>
</body>
</html>

<?php
require_once('footerclient.php');
}else{
	header('location:../connexion.php');
}
?>