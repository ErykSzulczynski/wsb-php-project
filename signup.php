<?php
    $is_invalid = false;
    $invalid_msg = "";

    #Jeżeli method w <form> = "post" to przechodzi if'a
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(empty($_POST["email"])) {
            $is_invalid = true;
            $invalid_msg = "Email is required";
            #die("Email is required");
        }

        if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $is_invalid = true;
            $invalid_msg = "Email is not valid";
            #die("Email is not valid");
        };

        if(strlen($_POST["password"]) < 8) {
            $is_invalid = true;
            $invalid_msg = "Password is too short";
            #die("Password is too short");
        }

        if($_POST["password"] !== $_POST["password_confirmation"]) {
            $is_invalid = true;
            $invalid_msg = "Passwords do not match";
            #die("Passwords do not match");
        }

        if($is_invalid == false) {
            $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $mysqli = require __DIR__ . "/database.php";
    
            $sql = "INSERT INTO user (name, email, role, password_hash) VALUES (?, ?, 'user', ?)";
    
            $stmt = $mysqli->prepare($sql);
    
            if(! $stmt->prepare($sql)) {
                die("SQL error: " . $mysqli->error);
            }
    
            $stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);
    
            if($stmt->execute()){
                header("Location: signup-successful.html");
                exit;
    
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rejestracja</title>
    <link href="./styles/style.css" rel="stylesheet"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
  </head>
  <body class="text-center">
    
    <main class="row justify-content-center align-items-center form-center w-100">
      <?php if($is_invalid): ?>
          <div class="validation-alert alert alert-danger w-100" role="alert">
              <?php echo $invalid_msg; ?>
          </div>
      <?php endif; ?>
      <form class="form-width w-25" method="post">
        <h1 class="h3 mb-3 fw-normal">Rejestracja</h1>
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="floatingInput"
            placeholder="username"
            name="name"
          />
          <label for="floatingInput">Nazwa użytkownika</label>
        </div>
        <div class="form-floating mt-3">
          <input
            type="email"
            class="form-control"
            id="floatingInput"
            placeholder="name@example.com"
            name="email"
          />
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mt-3">
          <input
            type="password"
            class="form-control"
            id="floatingPassword"
            placeholder="Password"
            name="password"
          />
          <label for="floatingPassword">Hasło</label>
        </div>
        <div class="form-floating mt-3">
            <input
              type="password"
              class="form-control"
              id="floatingPassword"
              placeholder="Password"
              name="password_confirmation"
            />
            <label for="floatingPassword">Powtórz hasło</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">
          Zarejestruj konto
        </button>
      </form>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
