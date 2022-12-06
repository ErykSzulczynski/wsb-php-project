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

    print_r($_POST);