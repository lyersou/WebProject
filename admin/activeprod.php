<?php include  '../config.php'; 

$id=$_GET['id'];
$produit_activé	=$_GET['produit_activé'];
$update = "UPDATE produit SET produit_activé=$produit_activé WHERE id_prod =$id";
mysqli_query($conn,$update);
header("Location:produits.php");
?>