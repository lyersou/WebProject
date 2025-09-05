<?php
include 'config.php';
$term = $_GET['term'];
// Query the database

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

  <style>
    .sect-contenu {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 60px;
    margin-left: 80px;
    text-align: center;
    margin-top: 1rem;
   }
    
  </style>
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
          <div class="col-md-12 mb-0"><a href="index.php">Accueil</a> <span class="mx-2 mb-0">/</span> <u class="text-black">Shop</u></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div>
          <h3><b>Voici le résultat pour "<?php echo $term ; ?>" </b></h3>
        </div>
    
        <div class="row">
        <div class="sect-contenu">
          


          <?php
           
            
         // Query the database
          $sql = "SELECT * FROM produit WHERE LOWER(nom_prod) LIKE '%" . mysqli_real_escape_string($conn, strtolower($term)) . "%'";
          $result = mysqli_query($conn, $sql);

          

          if (mysqli_num_rows($result) > 0) {
            
            
          // resultat de la requtte
          $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
          mysqli_free_result($result);
    
                 foreach ($rows as $row){
          
                  echo '<div class="card shadow" style="width: 18rem;">';
                    
                 echo '   <a > <img src="./images/' . $row["img"].'" alt="Image" width="286" height="250"></a>';
                 echo '<div class="card-body" >';
                 echo '<h2 style="font-weight: bold;">' . $row["nom_prod"] . '</h2>';
                 echo '<p style="height:20px">Type: ' .$row["type_prod"].'</p>';
                 echo '<p>Prix: ' . $row["prix_prod"] . ' DZ</p>';
                 echo '<a href="shop-single.php?id_prod='. $row["id_prod"] .'" class="btn btn-outline-dark">Détails</a>';
                 echo '</div>';
                 echo '</div>';
                 
               
            }
            } else {
              echo "No products found";
            }



// Close the database connection
mysqli_close($conn);

 ?>
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