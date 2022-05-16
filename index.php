<?php $page = 'home'; require 'header.php'; ?>

<main>
  <div class="jumbotron text-center">
    <h1 class="display-3">THE DATE</h1>
    <p class="lead">
      <!-- greeting the user based on their username, if they are logged in -->
      <?php
      if (isset($_SESSION['userID'])) {$greeting = ucfirst($_SESSION['username']);} else {$greeting = 'there';}
      echo 'Hello '.$greeting.', the date today is '.$date.'.';
      ?>
    </p>
  </div>

  <div class="container text-center mt-5">
    <h2>Want to learn more about <strong>THE DATE</strong>?</h2>
    <br>
    <div class="row">
      <div class="col-4">
        <a class="btn btn-primary btn-lg btn-block" href="https://www.google.com/search?q=the%20date" role="button">
          Search Google
        </a>
      </div>
      <div class="col-4">
        <a class="btn btn-primary btn-lg btn-block" href="https://en.wikipedia.org/wiki/Date" role="button">
          Read articles
        </a>
      </div>
      <div class="col-4">
        <a class="btn btn-primary btn-lg btn-block" href="https://www.amazon.co.uk/s?k=calendar" role="button">
          Buy a calendar
        </a>
      </div>
    </div>
  </div>

  <div class="container-fluid mt-5">
    <img src="/images/calendar.png" class="img-fluid mx-auto d-block" alt="calendar">
  </div>
</main>

<?php require 'footer.php'; ?>
