<?php
include  '../config.php'; 

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


      <div class="row">
      	<div class="col-10">
      		<h2>Catégories</h2>
      	</div>
      	
      </div>
      
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              
              <th>Id</th>
              <th>Name</th>
              
            </tr>
          </thead>
          <tbody>
            
          <?php
        // creation de requette

        $sql = " SELECT * FROM categorie  ";
      // excution la requtte 
      $result = mysqli_query($conn,$sql);
      // resultat de la requtte
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      mysqli_free_result($result);
      
                   foreach ($rows as $row){
                    echo ' <tr> ';
                    
                    echo ' <td>' . $row["id_cat"].' </td>';
                    echo ' <td>' . $row["nom_cat"].' </td> ';
                    echo '</tr>';
                   
                
                  }?>
                  
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


<?php include_once("./includes/footer.php"); ?>

