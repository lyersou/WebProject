<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM pharmacien WHERE id = $id";
$result = mysqli_query($conn, $sql);
$phar = mysqli_fetch_assoc($result);

$nom = $phar['nom_pharmacie'];
$lat = $phar['latitude'];
$lon = $phar['longitude'];



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
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" integrity="sha512-TBNugUp0/HzuSvclEmV7b63FgRO29h7O8WuzbMJsmvLlCQKrE9IktcTAKrZ04ldw6UZZO6Ug/3xqy6CDiZhFgA==" crossorigin=""/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" integrity="sha512-xdnhXzq3BLZpaw28ZgJt7ktu87aev8x/M4L4NxPNbV7pE9Xtd8V7oMvheQhVdM63FIt8+7Ooi4pl4bpxmVlxJg==" crossorigin=""></script>
    
  <style>
    
  .section{
    display: flex;
  }
  .table{
    width: 500px;
  }


    #map { height: 300px; width: 500px;}
  </style>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin="">
  </script>

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
          <div class="col-md-12 mb-0"><a href="index.php">Accueil</a> / <u class="text-black"><?php echo $phar['nom_pharmacie']; ?></u></div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="text-black" style="font-size:35px; text-decoration: underline; "><?php echo $phar['nom_pharmacie']; ?></h2>
              <div class="mt-5">
                <section class="section" >
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                      <table class="table custom-table" id="table">
                        <thead>
                          <th style="font-weight: bold; font-size:16px">COORDONNÉES :</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td><b>Adresse :</b>  <?php echo $phar['adresse']; ?></td>
                          </tr>
                          <tr>
                            <td><b>Email :</b>  <?php echo $phar['email']; ?></td>
                          </tr>
                          <tr>
                            <td><b>Numero du téléphone :</b>  <?php echo $phar['num_tel']; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-5 mb-lg-0" id="mapbanner">
                    <a  class="banner-1 h-100 d-flex " style="height: 300px; width: 500px;; margin-left:200px; border: 1px solid black; ">
                    <div id="map"></div>
                      <script>
                        var map = L.map('map').setView([36.0740, 4.7630],13);
                        var OpenStreetMap_France = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                        maxZoom: 20,
                        attribution: '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);
                        <?php
                          $conn = mysqli_connect('localhost:3307', 'root', '','pharmaa');

                          $query = "SELECT * FROM pharmacien WHERE id = $id";
                          $result = mysqli_query($conn, $query);
                           // Loop through location data and create marker for each location
                             while ($row = mysqli_fetch_assoc($result)) {
                                $id_phar = $row['id'];
                                $nom = $row['nom_pharmacie'];
                                $lat = $row['latitude'];
                                $lon = $row['longitude'];
                                echo "var marker$id_phar = L.marker([$lon, $lat]).addTo(map); marker$id_phar.bindPopup('<a>$nom</a>');";
                              }
                          ?>
                      </script>
                    </a>
                  </div>
                </section>
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
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>