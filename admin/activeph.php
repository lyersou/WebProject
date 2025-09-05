<?php include  '../config.php'; 

$id=$_GET['id'];
$pharmacie_activé	=$_GET['pharmacie_activé'];
$update = "UPDATE pharmacien SET pharmacie_activé=$pharmacie_activé WHERE id=$id";
mysqli_query($conn,$update);
header("Location:pharmacien.php");
?>