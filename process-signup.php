<?php

    if(empty($_POST["email"])) {
        die("Email is required");
    }

    if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        die("Email is not valid");
    };

    if(strlen($_POST["password"]) < 8) {
        die("Password is too short");
    }

    if($_POST["password"] !== $_POST["password_confirmation"]) {
        die("Passwords do not match");
    }

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

    