<?php

function throwError($error) {
  header("Location: ../signup.php?signup=0&error=$error");
  die();
}

if (isset($_POST['signup-submit'])) {

  require 'database.php';

  // get the details from the signup form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordRepeat = $_POST['password-repeat'];

  // validate the form input
  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat))
  {throwError('emptysignupfields');}
  
  else if (!preg_match("/^[a-zA-Z0-9_]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL))
  {throwError('badusernameandemail');}

  else if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)) {throwError('badusername');}

  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {throwError('bademail');}

  else if ($password !== $passwordRepeat) {throwError('nopasswordmatch');}
  
  else {
    // query the database for matching usernames
    $sql = "SELECT username FROM users WHERE username=?";
    $statement = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($statement, $sql)) {
      mysqli_stmt_bind_param($statement, "s", $username);
      mysqli_stmt_execute($statement);

      mysqli_stmt_store_result($statement);
      $resultcount = mysqli_stmt_num_rows($statement);

      // query the database for matching emails
      $sql = "SELECT email FROM users WHERE email=?";
      $statement = mysqli_stmt_init($conn);

      if (mysqli_stmt_prepare($statement, $sql)) {
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);

        mysqli_stmt_store_result($statement);
        $resultcount += mysqli_stmt_num_rows($statement);

        // if there are no matching usernames or emails then add the user to the database
        if ($resultcount == 0) {

          $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
          $statement = mysqli_stmt_init($conn);

          if (mysqli_stmt_prepare($statement, $sql)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);
            mysqli_stmt_execute($statement);

            header("Location: ../signup.php?signup=1"); die();

          } else {throwError('badsignupquery');}
        } else {throwError('infotaken');}
      } else {throwError('badsignupquery');}
    } else {throwError('badsignupquery');}
  }

  mysqli_stmt_close($statement);
  mysqli_close($conn);

} else {header("Location: ../signup.php"); die();}
?>