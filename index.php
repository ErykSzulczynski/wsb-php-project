<?php
  session_start();

  $mysqli = require __DIR__ . "/database.php";

  if(isset($_GET['id'])) {
    $sql = sprintf("DELETE FROM reservations WHERE id=".$_GET['id']);

    $result = $mysqli->query($sql);
  }

  if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $username = $_POST['username'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $sql = "UPDATE reservations SET user='$username', time='$time', date='$date', description='$description' WHERE id='$id'";
    if (mysqli_query($mysqli, $sql)) {
    } else {
     echo "Error: " . $sql . "
 " . mysqli_error($mysqli);
    }
  } else if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_SESSION['user_name'];
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
  <nav class="navbar navbar-light bg-light justify-content-between px-4">
    <a class="navbar-brand">Navbar</a>
    <div>
      <?php
          if(isset($_SESSION['user_id'])) {
            echo "Witaj, ". $_SESSION["user_name"] .'<a href="logout.php" class="btn btn-primary">Wyloguj</a>';
            if($_SESSION['user_role'] == "admin") {
              echo '<a href="admin.php" class="btn btn-primary">Panel Administratora</a>';
            }
          } else {
            echo '<a href="signin.php" class="btn btn-primary">Zaloguj</a><a href="signup.html" class="btn btn-primary">Zarejestruj</a>';
          }
        ?>
    </div>
  </nav>
  <div class="text-center">
    <h1>
      Asd
    </h1>
  </div>

<div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22508%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20508%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18534efdbc1%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18534efdbc1%22%3E%3Crect%20width%3D%22508%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22169.75%22%20y%3D%22123.6%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22508%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20508%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18534efdbc1%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18534efdbc1%22%3E%3Crect%20width%3D%22508%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22169.75%22%20y%3D%22123.6%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22508%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20508%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18534efdbc2%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18534efdbc2%22%3E%3Crect%20width%3D%22508%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22169.75%22%20y%3D%22123.6%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>

            
            
        
          </div>
        </div>
      </div>
      <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
          <h1 class="display-4 font-weight-normal">Zarezerwuj wizytę</h1>
          <?php
            if(isset($_SESSION['user_id'])) {
              echo '<form method="post">
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
              <button type="submit" class="btn btn-primary mt-3 w-100">Dodaj rezerwacje</button>
            </div>
            
            </form>';

            $username = $_SESSION["user_name"];

            $sql = sprintf("SELECT * FROM reservations WHERE user='$username'");
  
            $result = $mysqli->query($sql);

            echo '<table class="table">
            <thead class="table-light">
              <tr>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Opis</th>
                <th scope="col">Operacje</th>
              </tr>
            </thead>
            <tbody>';
            while($row = $result->fetch_assoc()) {
              echo "<tr>
                <td>" . $row["date"] . "</td>
                <td>" . $row["time"] . "</td>
                <td>" . $row["description"] . "</td>
                <td><a href='index.php?id=" . $row["id"] . "' class='btn btn-danger'>Usuń</a>
                <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#editModalCenter".$row["id"]."'".'>Edytuj</button></td>
              </tr>
              <div class="modal fade" id="editModalCenter'.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <label for="formGroupExampleInput">Id</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="id" value="'.$row["id"].'" readonly>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Nazwa użytkownika klienta</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="username" placeholder="Nazwa użytkownika" value="'.$row["user"].'">
                      </div>
                      <div class="form-group">
                        <label for="startDate">Dzień</label>
                        <input id="startDate" class="form-control" type="date" name="date" value="'.$row["date"].'"/>
                      </div>
                      <div class="form-group">
                        <label for="startTime">Godzina</label>
                        <input id="startTime" class="form-control" type="time" name="time" value="'.$row["time"].'"/>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Opis wizyty</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">'.$row["description"].'</textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                      <button type="submit" class="btn btn-primary">Edytuj</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>';

            }
            echo "</tbody>
            </table>";
            
            } else {
              echo '<p class="lead font-weight-normal">Nie jesteś zalogowany. Aby skorzystać z tej funckcji zaloguj się, lub stwórz konto</p>
              <a class="btn btn-outline-secondary" href="signin.php">Zaloguj się</a>';
            }
          ?>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
      </div>
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
