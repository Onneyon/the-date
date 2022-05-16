<!-- initialising the session as well as storing the date -->
<?php
session_start();
date_default_timezone_set('Europe/London');
$date = date('d/m/Y', time());
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags for Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&display=swap" rel="stylesheet">
    <!-- prism.js stylesheet -->
    <link rel="stylesheet" href="/style/prism.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/style/main.css">
    <!-- dynamic page title based on the current page -->
    <title>the date - <?php echo $page; ?></title>
  </head>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">the date</a>
    <!-- button to toggle the navbar using Bootsrap JS -->
    <button class="navbar-toggler" type="button" data-toggle="collapse"
    data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mr-auto">
        <!-- navbar with dynamically assigned active page indicators
        should probably be a function but the docs page complicates it-->
        <a class="nav-item nav-link <?php if($page == 'home'){echo 'active';}?>" href="/">Home</a>
        <a class="nav-item nav-link <?php if($page == 'signup'){echo 'active';}?>" href="/signup.php">Sign up</a>
        <a class="nav-item nav-link <?php if($page == 'docs'){echo 'active';}?>"
          href="/docs.php<?php if(isset($_SESSION['docs-section'])){echo '?section='.$_SESSION['docs-section'];}?>">Documentation</a>
      </div>
      <!-- login or logout forms displayed based on whether the user is currently logged in -->
      <?php
      if (isset($_SESSION['userID'])) {
        echo '<form class="form-inline my-2 my-lg-0" action="/logic/logout.php" method="post">
                <button class="btn btn-light my-2 my-sm-0" type="submit" name="logout-submit">Log Out</button>
              </form>';
       } else {
        echo '<form class="form-inline my-2 my-lg-0" action="/logic/login.php" method="post">
                <input class="form-control mr-sm-2" type="text" name="username" placeholder="Username" aria-label="Username">
                <input class="form-control mr-sm-2" type="password" name="password" placeholder="Password" aria-label="Password">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="login-submit">Log In</button>
              </form>';
      }
      ?>
    </div>
  </nav>
  <!-- display an error message based on any errors thrown by the login program -->
  <?php
    if ($_GET['login'] == 0) {
      $error = $_GET['error'];

      switch ($error) {
        case 'emptyloginfields':
          $errormessage = 'Please enter both a username and password';
          break;
        case 'invalidcredentials':
          $errormessage = 'Please enter a valid username and password combination';
          break;
        case 'badloginquery':
          $errormessage = 'SQL error - stop trying to break the website';
          break;
        default:
          // don't create an error message if there is no error
          break;
      }
      if (isset($errormessage)) {
        echo '<div class="container"><div class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">'
                .$errormessage.
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
             </div></div>';
      }
    } else {
      echo '<div class="container"><div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
              You have successfully logged in!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
           </div></div>';
   }
   ?>
<body>
