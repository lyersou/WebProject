<?php
include '../config.php';

if (!isset($_SESSION['id_admin'])) {
  header('Location: login.php');
  exit;
}

if (isset($_POST['Ajouter'])) {
  $nom = $_POST['name'];
  $id_cat = $_POST['categorie'];
  $desc = $_POST['desc'];
  $prix = $_POST['prix'];
  $type = $_POST['type'];
  $image = $_FILES['image']['name'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = '../images/' . $image;

  $desc = mysqli_real_escape_string($conn, $desc); // Escape the description to prevent SQL injection
  $nom = mysqli_real_escape_string($conn, $nom); // Escape the description to prevent SQL injection

  $dup = mysqli_query($conn, "SELECT * FROM `produit` WHERE `nom_prod` = '$nom'");
  if (mysqli_num_rows($dup) > 0) {
    header("location: produits.php?m=Nom produit déjà pris");
  } else {
    $sqlInsertProduit = "INSERT INTO produit (nom_prod, id_cat, description_prod, prix_prod, type_prod, img, produit_activé) VALUES ('$nom', '$id_cat', '$desc', '$prix', '$type', '$image', '1')";
    $result = mysqli_query($conn, $sqlInsertProduit);
    header("location: produits.php?ms=Nouveau produit ajouté avec succès");
  }
}

?>

<?php include_once("./includes/top.php"); ?>
<?php include_once("./includes/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    <?php include "./includes/sidebar.php"; ?>

    <?php
    if (isset($_GET['ms'])) {

      $ms = $_GET['ms'];
      echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
' . $ms . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="alt">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
';
    }

    ?>
    <?php
    if (isset($_GET['m'])) {

      $m = $_GET['m'];
      echo '
<div class="alert alert-warning alert-dismissible fade show" role="alert">
' . $m . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="alt">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
';
    }

    ?>

<?php 
if (isset($_GET['msg'])){

  $msg=$_GET['msg'];
  echo'
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  '.$msg.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="alt">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  ';
  
  }

?>

    <?php
    if (isset($_GET['pd'])) {

      $pd = $_GET['pd'];
      echo '
<div class="alert alert-primary alert-dismissible fade show" role="alert">
' . $pd . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="alt">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
';
    }

    ?>
    <div class="row">
      <div class="col-10">
        <h2>Produits</h2>

      </div>

      <div class="col-2">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ajouter_produit">
          Ajouter produit
        </button>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Image</th>
            <th>Prix</th>
            <th>Description</th>
            <th>Catégorie</th>
            <th>Type</th>
            <th>Action</th>
          </tr>
        </thead>
        <?php
        $query = "SELECT * FROM produit JOIN categorie ON produit.id_cat = categorie.id_cat";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {



        ?>
          <tbody>
            <tr>
              <td><?php echo $row['nom_prod']; ?></td>
              <td><?php echo '<img src="../images/' . $row["img"] . '" alt="Image" width="170" height="150">' ?></td>
              <td><?php echo $row['prix_prod']; ?>DZ</td>
              <td><?php echo $row['description_prod']; ?></td>
              <td><?php echo $row['nom_cat']; ?></td>
              <td><?php echo $row['type_prod']; ?></td>
              <td>
                <button class="btn btn-primary btn-sm" style="width: 82px;">
                <a href="modifier.php?modifier=<?php echo $row['id_prod']; ?>" class="text-light" >Modifier</a>

                </button>
              
                &nbsp;&nbsp;
                <?php

                if ($row['produit_activé'] == 1) {
                  echo '<p> <a href="activeprod.php?id=' . $row['id_prod'] . '&produit_activé=0" class="btn btn-success btn-sm" style="width: 82px;">Activer </a></p>';
                } else {
                  echo '<p> <a href="activeprod.php?id=' . $row['id_prod'] . '&produit_activé=1" class="btn btn-danger btn-sm ">Désactiver </a></p>';
                }

                ?>
              </td>
            </tr>

          <?php } ?>
          </tbody>
      </table>

    </div>
  </div>

  <form action="" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="ajouter_produit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-12">
              <div class="form-group">
                <label>Produit Nom</label>
                <input type="text" name="name" class="form-control" required value=''>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Catégorie Nom</label>
                <select class="form-control category_list" name="categorie" required value=''>
                  <option>Sélectionner catégorie</option>
                  <?php
                  $sql = "SELECT * FROM categorie";
                  $result = mysqli_query($conn, $sql);
                  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                  mysqli_free_result($result);
                  foreach ($rows as $row) {
                    echo '<option value="' . $row["id_cat"] . '">' . $row["nom_cat"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Produit Description</label>
                <textarea class="form-control" name="desc" required value=''></textarea>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Produit Prix</label>
                <input type="number" name="prix" class="form-control" required value=''>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Produit Type</label>
                <select class="form-control" name="type" required value=''>
                  <option>Sélectionner Type</option>
                  <option>Médicament</option>
                  <option>Biopharma</option>
                </select>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Produit Image</label>
                <input type="file" name="image" class="form-control" required value=''>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="Ajouter">Ajouter</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <?php include_once("./includes/footer.php"); ?>