<?php
include 'config.php';

// Number of items per page
$itemsPerPage = 9;

// Determine the current page
if (isset($_GET['page'])) {
  $currentPage = $_GET['page'];
} else {
  $currentPage = 1;
}

// Calculate the offset for the database query
$offset = ($currentPage - 1) * $itemsPerPage;



// Count the total number of products
$totalProducts = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pharmacien "));
$totalPages = ceil($totalProducts / $itemsPerPage);

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
          <div class="col-md-12 mb-0"><a href="index.php">Accueil</a> <span class="mx-2 mb-0">/</span> <u class="text-black">Pharmacies</u></div>
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
            
              // Query the database with pagination
$sql = "SELECT * FROM pharmacien WHERE pharmacie_activé='1' AND état='validé' LIMIT $itemsPerPage OFFSET $offset";
$result = mysqli_query($conn, $sql);

              // Display the product information on the webpage
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
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
                }
              } else {
                  echo "No pharmacie found";
              }
              mysqli_close($conn);
            ?>
          </div> 
          
        </div>
            </div>
      </div>
      <div class="pagination justify-content-center">
          <?php
          // Pagination links
          if ($currentPage > 1) {
            echo '<a class="btn btn-outline-dark" href="pharmacies.php?page=' . ($currentPage - 1) . '">Précédent</a>';
          }
          for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
              echo '<span class="btn btn-outline-dark active">' . $i . '</span>';
            } else {
              echo '<a class="btn btn-outline-dark" href="pharmacies.php?page=' . $i . '">' . $i . '</a>';
            }
          }
          if ($currentPage < $totalPages) {
            echo '<a class="btn btn-outline-dark" href="pharmacies.php?page=' . ($currentPage + 1) . '">Suivant</a>';
          }
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