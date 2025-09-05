<?php
include 'config.php';


$query = "SELECT * FROM pharmacien WHERE état = 'validé' AND pharmacie_activé = '1'";
$result = mysqli_query($conn, $query);

$id_prod = $_GET['id_prod']; // Retrieve the id_prod from the previous page

$sql = "SELECT * FROM produit WHERE id_prod = $id_prod";
$results = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($results);


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

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>

  <style>
    .sect-contenu {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 60px;
      margin-left: 80px;
      text-align: center;
      margin-top: 1rem;
    }

    #map { height: 450px; width: 1200px; }
  </style>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>

  <link rel="stylesheet" href="css/aos.css">
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
            <nav class="site-navigation text-right text-md-center">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="index.php">Accueil</a></li>
                <li><a href="shop.php">Produits</a></li>
                <li><a href="pharmacies.php">Pharmacies</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <div class="main-nav d-none d-lg-block">
              <nav class="site-navigation text-right text-md-center">
                <ul class="site-menu js-clone-nav d-none d-lg-block">
                  <li><a href="#" class="dropdown-toggle " data-toggle="dropdown">S'inscrire</a>
                    <ul class="dropdown-menu">
                      <ul class="dropdown">
                        <li><a href="registerph.php">Pharmacien</a></li>
                      </ul>
                    </ul>
                    <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
                  </li>
                  <li><a href="#" class="dropdown-toggle " data-toggle="dropdown">Se connecter</a>
                    <ul class="dropdown-menu">
                      <ul class="dropdown">
                        <li><a href="loginph.php">Pharmacien</a></li>
                      </ul>
                    </ul>
                    <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
                  </li>
                </ul>
                <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <h3 class="text-black">Votre résultat pour " <?php echo $rows['nom_prod']; ?> "</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container" style="height:500px">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a class="banner-1 h-100 d-flex " style="height:800px; width:1200px ; margin-left:-50px; border: 1px solid black; ">
              <div id="map" style="height: 500px;"></div>

              <!-- Leaflet map initialization script -->
              <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
              <script>
                var map = L.map('map').setView([36.0740, 4.7630], 14);

                // Add OpenStreetMap France as the base layer
                var OpenStreetMap_France = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                  maxZoom: 20,
                  attribution: '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                <?php


while ($row = mysqli_fetch_assoc($result)) {
  $id_phar = $row['id'];
  $nom = $row['nom_pharmacie'];
  $lat = $row['latitude'];
  $lon = $row['longitude'];

  // Check if the pharmacist has the specific product with quantity greater than 0
  $productQuery = "SELECT * FROM produit_dans_pharmacie WHERE id = $id_phar AND id_prod = $id_prod AND quantite > 0";
  $productResult = mysqli_query($conn, $productQuery);
  $hasProduct = mysqli_num_rows($productResult) > 0;

  if ($hasProduct) {
    echo "var marker$id_phar = L.marker([$lon, $lat]).addTo(map); marker$id_phar.bindPopup('<a href=\"pharmacie-single.php?id=$id_phar\">$nom</a>').on('click', function() { window.location.href = 'pharmacie-single.php?id=$id_phar'; }).openPopup();";
  }
}
?>



              </script>
            </a>
          </div>
        </div>
      </div>
    </div>

    <footer class="site-footer">
      <div class="container">
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
              Bienvenue à <a href="index.php" target="_blank">Pharma</a><i class="icon-heart" aria-hidden="true"></i>
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
