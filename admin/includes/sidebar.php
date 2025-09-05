
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

          <?php 


            $uri = $_SERVER['REQUEST_URI']; 
            $uriAr = explode("/", $uri);
            $page = end($uriAr);

          ?>


          <li class="nav-item">
            <a class="nav-link <?php echo ($page == '' || $page == 'index.php') ? 'active' : ''; ?>" href="index.php">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'demande.php') ? 'active' : ''; ?>" href="demande.php">
              <span data-feather="file"></span>
               Demandes 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'produits.php') ? 'active' : ''; ?>" href="produits.php">
              <span data-feather="shopping-cart"></span>
              Produits
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'categories.php') ? 'active' : ''; ?>" href="categories.php">
              <span data-feather="shopping-cart"></span>
              Catégories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'pharmacien.php') ? 'active' : ''; ?>" href="pharmacien.php">
              <span data-feather="users"></span>
              Pharmaciens
            </a>
          </li>
          
        </ul>

       
      </div>
    </nav>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bienvenue <?php
        // creation de requette

        $sql = " SELECT * FROM admin  ";
      // excution la requtte 
      $result = mysqli_query($conn,$sql);
      // resultat de la requtte
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      mysqli_free_result($result);
      
                   foreach ($rows as $row){
                   
                   echo '  ' . $row["username"].' ';
                   
                   
                  }?></h1>
        
      </div>