<?php
    session_start();
    //if(!isset($_SESSION["user_id"]) or $_SESSION["role"] != "admin") {
    //  header("Location: not_authorized.html");
    //}
    if(isset($_SESSION["user_id"]) == false) {
      header("Location: signin.php");
      exit;
    }

    if((isset($_SESSION["user_id"]) == false) || ($_SESSION["user_role"] != "admin")) {
      header("Location: not_authorized.html");
      exit;
    }

    $mysqli = require __DIR__ . "/database.php";

    if(isset($_GET['id'])) {
      $sql = sprintf("DELETE FROM reservations WHERE id=".$_GET['id']);
  
      $result = $mysqli->query($sql);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
      //$sql = sprintf("INSERT INTO reservations (null, date, time, description, user) VALUES (null, %s, %s, %s, %s)", $_POST['date'], $_POST['time'], $_POST['description'], $_POST['username']);

      //$result = $mysqli->query($sql);

      $username = $_POST['username'];
      $time = $_POST['time'];
      $date = $_POST['date'];
      $description = $_POST['description'];
      $sql = "INSERT INTO reservations (user,date,time,description)
      VALUES ('$username','$date','$time','$description')";
      if (mysqli_query($mysqli, $sql)) {
      } else {
       echo "Error: " . $sql . "
   " . mysqli_error($mysqli);
      }
    }
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
        <a href="admin.php" class="nav-link active" aria-current="page">
          Rezerwacje
        </a>
      </li>
      <li>
        <a href="users.php" class="nav-link text-white">
          Użytkownicy
        </a>
      </li>
    </ul>
    <hr>
    <a href="logout.php">
      <button type="button" class="btn btn-primary">Logout</button>
    </a>
    <a href="index.php" class="mt-2">
      <button type="button" class="btn btn-primary">Strona główna</button>
    </a>
  </div>
  <div class="d-flex flex-column p-4">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Dodaj rezerwacje
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
        <div class="form-group">
          <label for="formGroupExampleInput">Nazwa użytkownika klienta</label>
          <input type="text" class="form-control" id="formGroupExampleInput" name="username" placeholder="Nazwa użytkownika">
        </div>
        <div class="form-group">
          <label for="startDate">Dzień</label>
          <input id="startDate" class="form-control" type="date" name="date"/>
        </div>
        <div class="form-group">
          <label for="startTime">Godzina</label>
          <input id="startTime" class="form-control" type="time" name="time"/>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Opis wizyty</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        <button type="submit" class="btn btn-primary">Dodaj rezerwacje</button>
      </div>
      </form>
    </div>
  </div>
</div>  
  <table class="table">
  <thead class="table-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Data</th>
      <th scope="col">Użytkownik</th>
      <th scope="col">Operacje</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = sprintf("SELECT * FROM reservations");
  
      $result = $mysqli->query($sql);

      while($row = $result->fetch_assoc()) {
        echo "<tr>
          <th>" . $row["id"] . "</th>
          <td>" . $row["date"] . "</td>
          <td>" . $row["user"] . "</td>
          <td><a href='admin.php?id=" . $row["id"] . "' class='btn btn-danger'>Usuń</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-  datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
