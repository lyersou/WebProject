<?php
include 'config.php';
if (!isset($_SESSION['id'])) {
    header('location:interface.php');
}
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM `pharmacien` WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
}
$id_phar= $row["id"];
$nom = $row["nom"];
$prenom = $row["prenom"];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmer'])) {
    $qtValues = $_POST["qt"];
    $idProdValues = $_POST["id_prod"];
    $deleteQuery = "DELETE FROM produit_dans_pharmacie WHERE id = $id";
    mysqli_query($conn, $deleteQuery);
    foreach ($qtValues as $index => $qt) {
        $id_prod = $idProdValues[$index];
        $stmt = mysqli_prepare($conn, "INSERT INTO produit_dans_pharmacie (id, id_prod, quantite) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iii", $id, $id_prod, $qt);
        mysqli_stmt_execute($stmt);
    }
    $successMessage = 'Confirmation successful!';
}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Pharma|<?php echo strtoupper("$nom $prenom "); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
                    <div class="icons">
                        <a href="#" class="dropdown-toggle " data-toggle="dropdown"><?php echo strtoupper("$nom $prenom "); ?></a>
                        <ul class="dropdown-menu">
                            <ul class="dropdown">
                                <li><a href="modifierph.php?id=<?php echo "$id_phar"; ?>" >Modifier votre compte</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                                <li><a href="logoutph.php">Se déconnecter</a></li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <u class="text-black">Bienvenue dans votre espace <?php echo strtoupper("$nom $prenom "); ?></u>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                        <?php if (!empty($successMessage)) : ?>
                            <div class="alert alert-success"><?php echo $successMessage; ?></div>
                        <?php endif; ?>
                            <h3>Veuillez saisir vos informations</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Produit</th>
                                        <th class="product-type">Type</th>
                                        <th class="product-price">Prix</th>
                                        <th class="product-quantity">Quantité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM produit WHERE produit_activé='1'";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id_prod = $row['id_prod'];
                                            $nom_prod = $row['nom_prod'];
                                            $type_prod = $row['type_prod'];
                                            $prix_prod = $row['prix_prod'];
                                            $img = $row['img'];
                                    ?>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <?php echo '<img src="./images/' . $img . '" alt="Image" height=200px width=230px>'; ?>
                                                </td>
                                                <td class="product-name">
                                                    <h3><?php echo $nom_prod; ?></h3>
                                                </td>
                                                <td class="product-type">
                                                    <h4><?php echo $type_prod; ?></h4>
                                                </td>
                                                <td class="product-price">
                                                    <p><?php echo $prix_prod; ?> DZ</p>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3 ml-3">
                                                        <div class="input-group-prepend">
                                                            <div style="text-align: center; ">
                                                                <input type="number" name="qt[]" placeholder="Entrer votre quantité" required>
                                                                <input type="hidden" name="id_prod[]" value="<?php echo $id_prod; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <button type="submit" name="confirmer" class="btn btn-outline-dark" style="margin-left: 850px;">Confirmer votre liste</button>
                        </div>
                    </form>
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
