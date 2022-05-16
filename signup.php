<?php $page = 'signup'; require 'header.php'; ?>

<main>
    <div class="jumbotron text-center">
      <h1 class="display-3">SIGN UP</h1>
      <p class="lead">
        Receive daily date-based personalised status updates.
      </p>
    </div>

    <div class="container text-center">
      <!-- display an error message based on any errors thrown by the signup program -->
      <?php
        if ($_GET['signup'] == 0) {
          $error = $_GET['error'];

          switch ($error) {
            case 'emptysignupfields':
              $errormessage = 'Please fill in all fields of the sign up form';
              break;
            case 'badusernameandemail':
              $errormessage = 'Please enter an alphanumeric username and valid E-mail';
              break;
            case 'badusername':
              $errormessage = 'Please enter an alphanumeric username.';
              break;
            case 'bademail':
              $errormessage = 'Please enter a valid email';
              break;
            case 'nopasswordmatch':
              $errormessage = 'The two passwords you have entered do not match';
              break;
            case 'badsignupquery':
              $errormessage = 'SQL error - please stop trying to break the website';
              break;
            case 'infotaken':
              $errormessage = 'The username or E-mail you have entered is already in use';
              break;
            default:
              // don't create an error message if there is no error
              break;
          }
          // only display an alert box if there is an error
          // this avoids an empty box being displayed by default
          if (isset($errormessage)) {
          echo '<div class="alert alert-warning" role="alert">'
                .$errormessage.
                '</div>';
          }
       } else {
          echo '<div class="alert alert-success" role="alert">
                  You have successfully signed up! Please log in now
                </div>';
      }
      ?>
    </div>

    <!-- form that passes information to (and runs) the signup program -->
    <div class="container text-center">
      <form action="/logic/signup.php" method="post">
        <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username">
          <input type="text" class="form-control" name="email" placeholder="E-mail" aria-label="E-mail">
          <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password">
          <input type="password" class="form-control" name="password-repeat" placeholder="Repeat Password" aria-label="Repeat password">
        </div>
        <button type="submit" class="btn btn-outline-primary" name="signup-submit">Count me in!</button>
      </form>
    </div>
</main>

<?php require 'footer.php' ?>
