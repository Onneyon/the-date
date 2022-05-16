<?php

function throwError($error) {
  header("Location: ../index.php?login=0&error=$error");
  die();
}

if (isset($_POST['login-submit'])) {

  require 'database.php';

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!empty($username) && !empty($password)) {
    $sql = "SELECT * FROM users WHERE username=?";
    $statement = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($statement, $sql)) {
      mysqli_stmt_bind_param($statement, "s", $username);
      mysqli_stmt_execute($statement);

      $result = mysqli_stmt_get_result($statement);

      if ($row = mysqli_fetch_assoc($result)) {
        $passwordcheck = password_verify($password, $row['password']);

        if ($passwordcheck) {
          session_start();
          $_SESSION['userID'] = $row['id'];
          $_SESSION['username'] = $row['username'];

          header("Location: ../index.php?login=1"); die();

        } else {throwError('invalidcredentials');}
      } else {throwError('invalidcredentials');}
    } else {throwError('badloginquery');}
  } else {throwError('emptyloginfields');}

  mysqli_stmt_close($statement);
  mysqli_close($conn);

} else {header("Location: ../index.php"); die();}
