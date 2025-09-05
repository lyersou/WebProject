<?php include  '../config.php';

if (!isset($_SESSION['id_admin'])) {
  header('Location: login.php');
  exit;
}
?>
<?php include_once("./includes/top.php"); ?>
<?php include_once("./includes/navbar.php"); ?>

<?php 
         if (isset($_POST['valide'])){
            $id = $_POST['id'];
            $select= "UPDATE pharmacien SET état = 'validé' WHERE id='$id' ";
            $resuLt=mysqli_query($conn,$select);

            header("Location:pharmacien.php?msgg=Le Pharmacien est validé");
            
         } 
         if (isset($_POST['supprimer'])){
          $id = $_POST['id'];
          $select= "DELETE FROM pharmacien WHERE id='$id' ";
          $resut=mysqli_query($conn,$select);
          header("Location:demande.php?msg=Suppression terminée");
         } 
        ?>



<div class="container-fluid">



  <div class="row">
    

  
    <?php include "./includes/sidebar.php"; ?>
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
      <div class="row">
      	<div class="col-10">
      		<h2>Demandes Pharmaciens</h2>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              
              <th>Nom</th>
							<th>Prénom</th>
              <th>Address</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th>Nom Pharmacie</th>
              <th>Longitude</th>
              <th>Latitude</th>
              <th>État</th>
              <th>Action</th>
            </tr>
          </thead>
          <?php 
          $query= "SELECT * FROM pharmacien WHERE état = 'en attente' ORDER BY id ASC";

          $result = mysqli_query($conn,$query);          

          if($result == FALSE){

            echo "Echec de l'exécution de la requête";

          }else{         

                    while ($row = mysqli_fetch_array($result)) { ?>
                          
                          <tbody>
                            <tr> 
                              <td><?php echo $row['nom']; ?></td>
                              <td><?php echo $row['prenom']; ?></td>
                              <td><?php echo $row['adresse']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['num_tel']; ?></td>
                              <td><?php echo $row['nom_pharmacie']; ?></td>
                              <td><?php echo $row['longitude']; ?></td>
                              <td><?php echo $row['latitude']; ?></td>
                              <td><?php echo $row['état']; ?></td>

                              <td>
                                <form action="" method="POST">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                  <input type="submit" name="valide" value="Accepter"class="btn btn-success btn-sm"> &nbsp;&nbsp; 
                                  <input type="submit" name="supprimer" value="Supprimer" class="btn btn-danger btn-sm">
                                </form>                
                              </td>
                            </tr>
                          </tbody>
                          <?php 
                          }
          }
          ?>
        </table>
      </div>
      
  </div>
</div>


<?php include_once("./includes/footer.php"); ?>

