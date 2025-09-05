<?php
include 'config.php';

if (isset($_POST['submit'])) {
  $term = $_POST['term'];

  // Perform a case-insensitive database query to check if the search term exists in the database
  $query = "SELECT * FROM produit WHERE LOWER(nom_prod) LIKE '%" . mysqli_real_escape_string($conn, strtolower($term)) . "%'";
  $result = mysqli_query($conn, $query);

  if ($result === false) {
    die("Query failed: " . mysqli_error($conn));
  }

  if (mysqli_num_rows($result) > 0) {
    // The search term exists in the database
    // Redirect to the search results page or perform any desired action
    header("Location: resultat.php?term=" . urlencode($term));
    exit();
  } else {
    // No results found
    echo "<script>alert('No results found.');</script>";
  }
}
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
    #map { height: 450px; width: 1200px;}
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
                    <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
  </div>

    <div class="site-blocks-cover" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
            <div class="site-block-cover-content text-center">
              <h2 class="sub-title">Produits Pharmaceutiques à Proximité</h2>
              <h1>Bienvenue chez Pharma</h1>
              <p>
                <a href="shop.php" class="btn btn-primary px-5 py-3">Shop Maintenant</a>
              </p>
              <div id="search">
                <form class="d-flex" role="search"  method="post"> 
                  <input class="form-control me-2" type="text" name="term" placeholder="Nom du produit"  >
                  <input class="btn btn-info" type="submit" name="submit" value="rechercher" style="background-color: lightblue; color: black;">




                  
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Nos Produits</h2>
          </div>
        </div>

        <div class="row">
          <div class="sect-contenu">
            <?php
              // Query the database
              $sql = "SELECT * FROM produit WHERE produit_activé='1'";
              $result = mysqli_query($conn, $sql);

              // Display the product information on the webpage
              if (mysqli_num_rows($result) > 0) {
                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  if ($counter >= 3) {
                    break;
                  }

        
                  echo '<div class="card shadow" style="width: 18rem;">';
                    
                  echo '   <a > <img src="./images/' . $row["img"].'" alt="Image" width="286" height="250"></a>';
                  echo '<div class="card-body" >';
                  echo '<h2 style="font-weight: bold;">' . $row["nom_prod"] . '</h2>';
                  echo '<p style="height:20px">Type: ' .$row["type_prod"].'</p>';
                  echo '<p>Prix: ' . $row["prix_prod"] . ' DZ</p>';
                  echo '<a href="shop-single.php?id_prod='. $row["id_prod"] .'" class="btn btn-outline-dark">Détails</a>';
                  echo '</div>';
                  echo '</div>';

                  $counter++;
                }
              } else {
                echo "No products found";
              }
            ?>
          </div>   
        </div>
        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="shop.php" class="btn btn-primary px-4 py-3">Voir tous les produits</a>
          </div>
        </div>
      </div>
    </div>



    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Pharmacies Les Plus Visitées</h2>
          </div>
        </div>

        <div class="row">
          <div class="sect-contenu">
            <?php
            // Query the database
              $sql = "SELECT * FROM pharmacien WHERE état = 'validé'AND pharmacie_activé='1'";
              $result = mysqli_query($conn, $sql);

              // Display the product information on the webpage
              if (mysqli_num_rows($result) > 0) {
                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  if ($counter >= 3) {
                  break;
                }
                  // Retrieve the product information from the result set
                  $id_phar= $row['id'];
                  $nomph = $row['nom_pharmacie'];
                  $num = $row['num_tel'];

     
     
                  // Display the product information on the webpage
                  echo '<div class="card shadow" style="width: 18rem;">';
                  echo '<div class="card-body" >';
                  echo '<h2 style="height:60px; font-size:24px; font-weight: bold;">' . $nomph . '</h2>';
                  echo '<h2 style="height:60px; font-size:20px ">' . $num . '</h2>';
                  echo '<a href="pharmacie-single.php?id='. $id_phar .'" class="btn btn-outline-dark">Détails</a>';
                  echo '</div>';
                  echo '</div>';
                  $counter++;
                }
              } else {
                  echo "No pharmacie found";
              }
              mysqli_close($conn);
            ?>
        </div> 
        </div>

        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="pharmacies.php" class="btn btn-primary px-4 py-3">Voir tous les pharmacies</a>
          </div>
        </div> 
      </div>
    </div>

    <div class="site-section " >
      <div class="container" style="height:500px">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a  class="banner-1 h-100 d-flex " style="height:800px; width:1200px ; margin-left:-50px; border: 1px solid black; ">
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
  
   $conn = mysqli_connect('localhost:3307', 'root', '','pharmaa');

  $query = "SELECT * FROM pharmacien WHERE état = 'validé'AND pharmacie_activé='1'";
  $result = mysqli_query($conn, $query);
    // Loop through location data and create marker for each location
    while ($row = mysqli_fetch_assoc($result)) {
      $id_phar = $row['id'];
      $nom = $row['nom_pharmacie'];
      $lat = $row['latitude'];
      $lon = $row['longitude'];
      echo "var marker$id_phar = L.marker([$lon, $lat]).addTo(map); marker$id_phar.bindPopup('<a href=\"pharmacie-single.php?id=$id_phar\">$nom</a>').on('click', function() {
        window.location.href = 'pharmacie-single.php?id=$id_phar';
      }).openPopup();";
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
