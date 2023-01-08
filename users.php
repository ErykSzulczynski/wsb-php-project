<?php
    session_start();

    $mysqli = require __DIR__ . "/database.php";

    if(isset($_SESSION["user_id"]) == false) {
      header("Location: signin.php");
      exit;
    }

    if((isset($_SESSION["user_id"]) == false) || ($_SESSION["user_role"] != "admin")) {
      header("Location: not_authorized.html");
      exit;
    }


    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["user_id"])) {
        $id = $_POST["user_id"];
        $username = $_POST['username'];
        $email = $_POST['email'];
  
        $sql = "UPDATE user SET name='$username', email='$email' WHERE id='$id'";
  
        if (mysqli_query($mysqli, $sql)) {} else {
            echo "Error: " . $sql . mysqli_error($mysqli);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel Administratora - Użytkownicy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
</head>

<body>
    <main class="d-flex flex-nowrap">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 100vh;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
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
            <a href="index.php" class="mt-2">
                <button type="button" class="btn btn-primary">Strona główna</button>
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
                            echo '<tr>
                              <th>' . $row["id"] . '</th>
                              <td>' . $row["name"] . '</td>
                              <td>' . $row["email"] . '</td>
                              <td><button type="button" class="btn btn-danger">Usuń</button>
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUserModalCenter'.$row["id"].'">Edytuj</button></td>
                            </tr>
                            <div class="modal fade" id="editUserModalCenter'.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Edycja użytkownika</h5>
                                </div>
                                <div class="modal-body">
                                  <form method="post">
                                  <div class="form-group">
                                    <label for="formGroupExampleInput">Id użytkownika</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="user_id" value="'.$row["id"].'" readonly>
                                  </div>
                                  <div class="form-group">
                                    <label for="formGroupExampleInput">Nazwa użytkownika klienta</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="username" placeholder="Nazwa użytkownika" value="'.$row["name"].'">
                                  </div>
                                  <div class="form-group">
                                    <label for="formGroupExampleInput">Nazwa użytkownika klienta</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="email" placeholder="Email" value="'.$row["email"].'">
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
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-  datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
    </script>
</body>

</html>