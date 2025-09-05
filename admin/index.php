<?php
include '../config.php';
include "./includes/top.php";
include "./includes/navbar.php";

// Check if the admin is logged in; redirect to login page if not
if (!isset($_SESSION['id_admin'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST["Modifier"])) {
    $id = $_POST["id_admin"];
    $nom = $_POST['nom'];
    $pass = $_POST['password'];

    $nom = mysqli_real_escape_string($conn, $nom);

    $select = "UPDATE `admin` SET `username`='$nom',`password`='$pass' WHERE id_admin = '$id' ";

    $resuLt = mysqli_query($conn, $select);
    header("Location:index.php?msg=Modification Terminée");
    exit;
}

?>

<div class="container-fluid">
    <div class="row">
        <?php include "./includes/sidebar.php"; ?>

        <?php if (isset($_GET['msg'])) : ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <?php echo $_GET['msg']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="alt">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <h2>Admin</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom utilisateur</th>
                        <th>Mot de passe</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM admin";
                    $result = mysqli_query($conn, $sql);
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    foreach ($rows as $row) {
                        echo '<tr>';
                        echo '<td>' . $row["id_admin"] . '</td>';
                        echo '<td>' . $row["username"] . '</td>';
                        echo '<td>' . $row["password"] . '</td>';
                        echo '<td>
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modifier' . $row['id_admin'] . '">
                                  Modifier
                              </button>
                              </td>';
                        echo '</tr>';
                    }
                    mysqli_free_result($result);
                    ?>
                </tbody>
            </table>
        </div>

        <?php foreach ($rows as $row) : ?>
            <form action="" method="POST">
                <div class="modal fade" id="modifier<?php echo $row['id_admin']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modifier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="nom" class="form-control" placeholder="Enter Nom" value="<?php echo $row['username']; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" placeholder="Enter Password" value="<?php echo $row['password']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary" name="Modifier">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>

    </div>
</div>

<?php include "./includes/footer.php"; ?>