<?php
    session_start();

    //var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Logowanie</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="styles/style.css"/>
  </head>
  <body>
  <main class="d-flex flex-nowrap">
  <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Panel Administratora
      </span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="admin.php" class="nav-link text-white" aria-current="page">
          Rezerwacje
        </a>
      </li>
      <li>
        <a href="users.php" class="nav-link text-white active">
          Użytkownicy
        </a>
      </li>
    </ul>
    <hr>
    <a href="logout.php">
      <button type="button" class="btn btn-primary">Logout</button>
    </a>
  </div>
  <div class="d-flex flex-column p-4">
  <table class="table">
  <thead class="table-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nazwa Użytkownika</th>
      <th scope="col">Email</th>
      <th scope="col">Operacje</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $mysqli = require __DIR__ . "/database.php";
      $sql = sprintf("SELECT * FROM user");
  
      $result = $mysqli->query($sql);

      while($row = $result->fetch_assoc()) {
        echo "<tr>
          <th>" . $row["id"] . "</th>
          <td>" . $row["name"] . "</td>
          <td>" . $row["email"] . "</td>
          <td><button type='button' class='btn btn-danger'>Usuń</button>
          <button type='button' class='btn btn-warning'>Edytuj</button></td>
        </tr>";
      }
    ?>
    <!--<tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>-->
  </tbody>
</table>
  </div>
  </main>
  
    <!--<h1>Home</h1>
    <h1><a href="logout.php">Log Out</a></h1>-->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
