
<?php
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
								<li><a href="index.php"><i class="fa fa-home"></i> Accueil</a></li>
								<li><a href="panier.php"><i class="fa fa-heart-o"></i> Mon panier</a></li>
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



	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
	<?php
	if(isset($_GET['searchbtn'])){
		require_once('../db/connexion_db.php');
		$formationrecherche = htmlspecialchars($_GET['formationrecherche']);
		$selectformationrecherche = $bd->prepare("SELECT * FROM formation WHERE titre like '%".$formationrecherche."%' ORDER BY id DESC");
		$selectformationrecherche->execute();
		while($recherche = $selectformationrecherche->fetch()){

?>
      <div class="col-md-3 col-sm-6 col-xs-6">
                 <div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>New</span>
									</div>
									<button class="main-btn quick-view"><i class="fa fa-search-plus"></i><a href="?action=voirformation&amp;id=<?php echo $recherche['id'];?>">voir les details</a></button>
									<img src="../formation_images/<?php echo $recherche['titre'];?>"/>
								</div>
								<div class="product-body">
									<h3 class="product-price"><?php echo $recherche['prix'];?> <del class="product-old-price">$45.00</del></h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a href="#"><?php echo $recherche['titre'];?></a></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</div>
								</div>
							</div>
     </div>
<?php
	}
}
?>

</div>

</div>

</div>
    
</body>

</html>

<?php
}
?>
