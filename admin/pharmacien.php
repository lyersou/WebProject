<?php include  '../config.php';
if (!isset($_SESSION['id_admin'])) {
  header('Location: login.php');
  exit;
}
?>
<?php include_once("./includes/top.php"); ?>
<?php include_once("./includes/navbar.php"); ?>


<div class="container-fluid">
  <div class="row">
    
    <?php include "./includes/sidebar.php"; ?>
    <?php 
if (isset($_GET['msgg'])){

$msgg=$_GET['msgg'];
echo'
<div class="alert alert-success alert-dismissible fade show" role="alert">
'.$msgg.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="alt">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
';

}

?>  
      <div class="row">
      
      

      	<div class="col-10">
      		<h2>Pharmaciens</h2>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              
              <th>Nom</th>
							<th>Prénom</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th>Address</th>
              <th>Nom Pharmacie</th>
              <th>Longitude</th>
              <th>Latitude</th>
              <th>État</th>
              <th>Action</th>
            </tr>
          </thead>
          <?php 
          $query= "SELECT * FROM pharmacien WHERE état = 'validé' ";

          $result = mysqli_query($conn,$query);

          while ($row = mysqli_fetch_array($result )) { ?>
          
          <tbody>
            <tr>
              
              <td><?php echo $row['nom']; ?></td>
              <td><?php echo $row['prenom']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['num_tel']; ?></td>
              <td><?php echo $row['adresse']; ?></td>
              <td><?php echo $row['nom_pharmacie']; ?></td>
              <td><?php echo $row['longitude']; ?></td>
              <td><?php echo $row['latitude']; ?></td>
              <td><?php echo $row['état']; ?></td>
              
              <td>

              <?php 
              if($row['pharmacie_activé']==1){
                echo'<p> <a href="activeph.php?id='.$row['id'].'&pharmacie_activé=0" class="btn btn-success btn-sm" style="width: 82px;">Activer </a></p>';
              }else{
                echo'<p> <a href="activeph.php?id='.$row['id'].'&pharmacie_activé=1" class="btn btn-danger btn-sm" style="width: 82px;">Désctiver </a></p>';
              }
              ?>

              </td>
              
              

              
              
            </tr>
          
          <?php } ?>
          </tbody>

        </table>
      </div>
    </main>
  </div>
</div>


<?php include_once("./includes/footer.php"); ?>


