<?php
  $is_invalid = false;

  #Jeżeli method w <form> = "post" to przechodzi if'a
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";
    
    #Tworzenie polecenia wyciągnięcia użytkowników z bazy   wyrzucenie z email'a specjalnych znaków
    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST['email']));

    #Wykonanie zapytania do bazy
    $result = $mysqli->query($sql);

    #Przypisanie rezultatów zapytania
    $user = $result->fetch_assoc(); ##[{dane user'a}] -> {dane user'a}

    #Jeżeli jakiś user pasuje do podanego email'a
    if($user) {
      #Sprawdzenie czy hasło przesłane przez użytkownika jest takie samo jak w bazie
      if(password_verify($_POST["password"], $user["password_hash"])) {
        session_start();
        session_regenerate_id();

        #Wrzucenie informacji o użytkowniku do sesji
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_role"] = $user["role"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["user_email"] = $user["email"];


        header("Location: index.php");
        exit;
      }
    }

    $is_invalid = true;
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Logowanie - Gabinet Fizjoterapii - John Doe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
</head>

<body class="text-center">
    <main class="row justify-content-center align-items-center form-center w-100">
        <?php if($is_invalid): ?>
        <div class="validation-alert alert alert-danger" role="alert">
            Logowanie nie powiodło się, spróbuj ponownie
        </div>
        <?php endif; ?>
        <form class="form-width w-25" method="post">
            <h1 class="h3 mb-3 fw-normal">Logowanie</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email"
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" />
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    name="password" />
                <label for="floatingPassword">Hasło</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">
                Zaloguj
            </button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>