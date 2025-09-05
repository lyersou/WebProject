<?php
include 'config.php';




$id = $_GET['id_prod'];






// fetch the product with the given id from the database
$sql = "SELECT * FROM produit WHERE id_prod = $id";
$result = mysqli_query($conn, $sql);
$produit = mysqli_fetch_assoc($result);

$img = $produit['img'];
$base64_image= base64_encode($img);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Pharma</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="site-wrap">


<div class="site-navbar py-2">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between">
      <div class="logo">
        <div class="site-logo">
          <a href="index.php"><img src="images/pharma1.png" alt="Image" width="60"></a>
        </div>
      </div>
      <div class="main-nav d-none d-lg-block">
        <nav class="site-navigation text-right text-md-center" >
          <ul class="site-menu js-clone-nav d-none d-lg-block">
            <li class="active"><a href="index.php">Accueil</a></li>
            <li><a href="shop.php">Produits</a></li>
            <li><a href="pharmacies.php">Pharmacies</a></li>
          </ul>
        </nav>
      </div>
      <div class="icons">
        <div class="main-nav d-none d-lg-block">
          <nav class="site-navigation text-right text-md-center" >
            <ul class="site-menu js-clone-nav d-none d-lg-block">
              <li><a href="#" class="dropdown-toggle " data-toggle="dropdown">S'inscrire</a>
                <ul class="dropdown-menu">
                  <ul class="dropdown">
                    <li><a href="registerph.php">Pharmacien</a></li>
                  </ul> 
                </ul>
                <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
              </li>
              <li ><a href="#" class="dropdown-toggle " data-toggle="dropdown">Se connecter</a>
                <ul class="dropdown-menu">
                  <ul class="dropdown">
                    <li><a href="loginph.php">Pharmacien</a></li>
                  </ul> 
                </ul>
                <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Accueil</a> <span class="mx-2 mb-0">/</span> <a
              href="shop.php">Shop</a> <span class="mx-2 mb-0">/</span> <u class="text-black"><?php echo $produit['nom_prod']; ?></u></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-5 mr-auto">
            <div class="border text-center">
            <?php echo '<img src="./images/' . $produit["img"].'" alt="Image" class="img-fluid p-5">'; ?>
            </div>
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $produit['nom_prod']; ?></h2>
      
            <p><strong class="background-color h4"><?php echo $produit['prix_prod']; ?> DZ</strong></p>
            
            
            <p><a href="proxemite.php?id_prod=<?php echo $id; ?>" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Trouver à proximité</a></p>


            <div class="mt-5">
            
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <table class="table custom-table">
                    <thead>
                      <th>Description :</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $produit['description_prod']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
             
              </div>
            </div>

    
          </div>
        </div>
      </div>
    </div>

    <footer class="site-footer">
      <div class="container">
        
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
            Bienvenue à <a href="index.php" target="_blank">Pharma </a><i class="icon-heart" aria-hidden="true"></i>
           </p>
          </div>
        </div>
      </div>
    </footer>

  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>