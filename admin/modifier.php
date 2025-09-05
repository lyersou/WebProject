<?php
include '../config.php';
if (!isset($_SESSION['id_admin'])) {
  header('Location: login.php');
  exit;
}

$id = $_GET['modifier'];
if (isset($_POST['Modifier'])) {
  $nom = $_POST['name'];
  $id_cat = $_POST['categorie'];
  $desc = $_POST['desc'];
  $prix = $_POST['prix'];
  $type = $_POST['type'];
  $desc = mysqli_real_escape_string($conn, $desc);
  $nom = mysqli_real_escape_string($conn, $nom);

  // Check if a new image file is uploaded
  if ($_FILES['image']['name']) {
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../images/';
    $image_path = $image_folder . $image;

    // Move the uploaded image to the 'images' folder
    move_uploaded_file($image_tmp_name, $image_path);
  } else {
    // No new image uploaded, retrieve the existing image from the database
    $query = "SELECT img FROM produit WHERE id_prod = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $image = $row['img'];
  }

  $duplicate = mysqli_query($conn, " SELECT * FROM `produit` WHERE `nom_prod` = '$nom' ");

  if(mysqli_num_rows($duplicate)>0){
    header("Location: produits.php?msg=Le nom du produit existe déjà.");
  }
    else{

      $select = "UPDATE produit SET nom_prod='$nom', id_cat='$id_cat', description_prod='$desc', prix_prod='$prix', type_prod='$type', img='$image' WHERE id_prod='$id'";

      $result = mysqli_query($conn, $select);
      
      header("Location: produits.php?pd=Modification Terminée");
      exit();

    }
  
}

include_once("./includes/top.php");
include_once("./includes/navbar.php");
?>

 

<div class="container-fluid">
  <div class="row">
    <?php include "./includes/sidebar.php"; ?>

    <div class="col-10">
      <h2>Modifier Produit</h2>
    </div>
  </div>

  <!-- Edit Product Modal start -->
  <?php
  $query = "SELECT * FROM produit JOIN categorie ON produit.id_cat = categorie.id_cat WHERE id_prod = '$id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="modal-body" style="margin-left:35%;width: 650px;">
      <div class="col-12">
        <div class="form-group">
          <label>Produit Nom</label>
          <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['nom_prod']); ?>">
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label>Catégorie Nom</label>
          <select class="form-control category_list" name="categorie">
            <option>Sélectionner catégorie</option>
            <?php
            $sql = "SELECT * FROM categorie";
            $result_cat = mysqli_query($conn, $sql);
            while ($cat = mysqli_fetch_assoc($result_cat)) {
              $selected = ($cat['id_cat'] == $row['id_cat']) ? 'selected' : '';
              echo '<option value="' . $cat["id_cat"] . '" ' . $selected . '>' . htmlspecialchars($cat["nom_cat"]) . '</option>';
            }
            mysqli_free_result($result_cat);
            ?>
          </select>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label>Produit Description</label>
          <textarea name="desc" class="form-control"><?php echo htmlspecialchars($row['description_prod']); ?></textarea>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label>Produit Prix</label>
          <input type="number" name="prix" class="form-control" value="<?php echo htmlspecialchars($row['prix_prod']); ?>">
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label>Produit Type</label>
          <select class="form-control" name="type">
            <option>Sélectionner Type</option>
            <option <?php echo ($row['type_prod'] == 'Médicament') ? 'selected' : ''; ?>>Médicament</option>
            <option <?php echo ($row['type_prod'] == 'Biopharma') ? 'selected' : ''; ?>>Biopharma</option>
          </select>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          
            <img src="../images/<?php echo $row['img']; ?>" alt="<?php echo $row['img']; ?>" style="width: 200px;">
          
          <input type="file" name="image" class="form-control" accept="image/jpg,image/png,image/svg">
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-primary" name="Modifier" style="margin-left:73%;">Modifier</button>
      <a href="produits.php" class="btn btn-secondary">Fermer</a>
    </div>
  </form>
</div>

<?php include_once("./includes/footer.php"); ?>