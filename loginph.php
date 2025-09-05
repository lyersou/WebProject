

<?php
include  'config.php';
 if(!empty($_SESSION["id_ph"])){
  header("Location : interface.php");

 }
 if (isset ($_POST["submit"])){
  $username = $_POST["username"];
  $password = $_POST["password"];

  $username = mysqli_real_escape_string($conn, $username);
  $sql = " SELECT * FROM `pharmacien` WHERE username = '$username' AND pharmacie_activé='1'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);

  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: interface.php");
    }
    else{
      echo
      "<script> alert('Le mot de passe incorrect'); </script>";
    }
  }
  else{
    echo
    "<script> alert('Utilisateur non enregistré'); </script>";
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
              <li><a href="#" class="dropdown-toggle " data-toggle="dropdown">S'inscrir</a>
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
          <div class="col-md-12 mb-0">
            <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
            <u class="text-black">Se connecter</u>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Bienvenue notre Pharmacien</h2>
          </div>
          <div class="col-md-12">
    
            <form action="" method="post">
    
              <div class="p-6 p-lg-5 ">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black"style="margin-left:11%;width:800px;">Nom utilisateur</label>
                    <input type="text" class="form-control"style="margin-left:11%;width:800px;"  name="username" required>
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Mot de passe</label>
                    <input type="password" class="form-control"style="margin-left:11%;width:800px;"  name="password" required>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <input type="submit"     name="submit" class=" btn-lg btn-block"style="margin-left:30%;width: 450px;" value="Se connecter">
                </div>
              </div>
            </form>
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