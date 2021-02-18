<?php
session_start();
include('headerclient.php');
require_once('../db/connexion_db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les categories</title>

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
    

<?php

if(isset($_GET['action'])){
    if($_GET['action'] == 'voirformation'){
        $idrecup = $_GET['id'];
        $selectformationclick = $bd->prepare("SELECT * FROM formation WHERE id = $idrecup");
        $selectformationclick->execute();
   while($donnebase = $selectformationclick->fetch()){
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
                            <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
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
$selectcategorie = $bd->prepare("SELECT * FROM categories");
$selectcategorie->execute();
while($buttoncat = $selectcategorie->fetch()){
?>

<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
     <button class="btn btn-basic" style="margin-top:20px; width:100%;background:rgb(74, 155, 248);"> 
     <a href="?category=<?php echo $buttoncat['nom_categorie'];?>" style="color:white;"> <b>
     <?php echo $buttoncat['nom_categorie']; ?></a></b><br></button>

<?php
    if(isset($_GET['category'])){
        $nomcat = $buttoncat["nom_categorie"];
        if($_GET['category'] == $nomcat){
            $selectformation = $bd->prepare("SELECT * FROM formation WHERE categories = '$nomcat'");
            $selectformation->execute();
            while($formselectbycat = $selectformation->fetch()){
?> 

    <div class="col-md-3 col-sm-6 col-xs-6">
                   <div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>New</span>
									</div>
									<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> <a href="?action=voirformation&amp;id=<?php echo $formselectbycat['id'];?>">voir les details</a> </button>
									<img src="../formation_images/<?php echo $formselectbycat['titre'];?>"/>
								</div>
								<div class="product-body">
									<h3 class="product-price">cfa <?php echo $formselectbycat['prix'];?> <del class="product-old-price"></del></h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a href="#"><?php echo $formselectbycat['titre'];?></a></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
									</div>
								</div>
							</div>
</div>
			
   

<?php
            }
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
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
   require_once('footerclient.php');
?>

</body>
</html>