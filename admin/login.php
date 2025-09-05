 <?php
include  '../config.php';



if(!empty($_SESSION["id_admin"])){
  header("Location : index.php");

 }

 if (isset ($_POST["submit"])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $sql = " SELECT * FROM `admin` WHERE username = '$username' ";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result)> 0 ){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id_admin"] = $row["id_admin"];
      header("Location:index.php");
      
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


<?php include "./includes/top.php"; ?>
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

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
      <br><br>
			<h4>Bienvenue notre Admin</h4>  
			<p class="message"></p>
			<form method="post">
			  <div class="form-group">
			    <label for="text">Nom utilisateur</label>
			    <input type="text" class="form-control" placeholder="Nom utilisateur" name="username">
			    
			  </div>
			  <div class="form-group">
			    <label for="password">Mot de passe</label>
			    <input type="password" class="form-control"  placeholder="Mot de passe" name="password">
			  </div>
			  <input type="submit"class="btn btn-primary login-btn"   name="submit" value="Se connecter" >
			</form>
		</div>
	</div>
</div>






