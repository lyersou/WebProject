<?php
include 'config.php';

if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM `pharmacien` WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
} else {
  header("Location: index.php");
}

$username = $row['username'];
$nom = $row['nom'];
$prenom = $row['prenom'];
$address = $row['adresse'];
$email = $row['email'];
$num_tele = $row['num_tel'];
$nomph = $row['nom_pharmacie'];
$long = $row['longitude'];
$lati = $row['latitude'];

if (isset($_POST["submit"])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['cpassword'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $address = $_POST['adresse'];
  $email = $_POST['email'];
  $num_tele = $_POST['num_tel'];
  $nomph = $_POST['nomph'];
  $long = $_POST['long'];
  $lati = $_POST['lati'];

  $duplicate = mysqli_query($conn, "SELECT * FROM `pharmacien` WHERE `username` = '$username' AND `id` != '$id'");
  if (mysqli_num_rows($duplicate) > 0) {
    echo "<script> alert('Nom d'utilisateur est déjà pris'); </script>";
  } else {
    if ($password == $confirmpassword) {
      $query = "UPDATE `pharmacien` SET username='$username', password='$password', nom='$nom', prenom='$prenom', adresse='$address', email='$email', num_tel='$num_tele', nom_pharmacie='$nomph', longitude='$long', latitude='$lati' WHERE id='$id'";
      mysqli_query($conn, $query);
      header("Location: interface.php?id=$id");
      echo "<script> alert('Modification réussie'); </script>";
    } else {
      echo "<script> alert('Le mot de passe ne correspond pas'); </script>";
    }
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
                <li class="active"><a href="interface.php?id=<?php echo "$id"; ?>">Retour à votre espace</a></li>
              </ul>
            </nav>
          </div>
                    <div class="icons">
                        <a href="#" class="dropdown-toggle " data-toggle="dropdown"><?php echo strtoupper("$nom $prenom "); ?></a>
                        <ul class="dropdown-menu">
                            <ul class="dropdown">
                                <li><a href="modifierph.php?id=<?php echo "$id"; ?>" >Modifier votre compte</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                                <li><a href="logoutph.php">Se deconnecter</a></li>
                            </ul>
                        </ul>
                        <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                                class="icon-menu"></span></a>
                    </div>
                </div>
            </div>
        </div>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a >Modifier votre compte</a> 
        </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Modifier vos informations</h2>
          </div>
          <div class="col-md-12">
    
            <form action="#" method="post">
    
              <div class="p-6 p-lg-5 ">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black"style="margin-left:11%;width:800px;">Nom utilisateur</label>
                    <input name ="username" type="text" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $username;?>">
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Mot de passe</label>
                    <input name="password" type="password" class="form-control"style="margin-left:11%;width:800px;" >
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Confirmer mot de passe</label>
                    <input name="cpassword" type="password" class="form-control"style="margin-left:11%;width:800px;" required  >
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Nom</label>
                    <input name="nom" type="text" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $nom;?>">
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Prénom</label>
                    <input name="prenom" type="text" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $prenom;?>">
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Adresse</label>
                    <input name="adresse" type="text" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $address;?>">
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Email</label>
                    <input name="email" type="email" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $email;?>">
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Num de téléphonne</label>
                    <input name="num_tel" type="text" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $num_tele;?>">
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Nom de votre pharmacie</label>
                    <input name="nomph" type="text" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $nomph;?>">
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Longitude de votre pharmacie</label>
                    <input name="long" type="text" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $long;?>">
                  </div>
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black"style="margin-left:11%;width:800px;">Latitude de votre pharmacie</label>
                    <input name="lati" type="text" class="form-control"style="margin-left:11%;width:800px;" placeholder="<?php echo $lati;?>">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <input type="submit" name ='submit' class=" btn-lg btn-block"style="margin-left:30%;width: 450px;" value="MODIFIER">
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