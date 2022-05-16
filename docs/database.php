<?php require 'logic/database.php'; ?>

<h5>Overview</h5>
<p>
  This is the MariaDB database used to store user information.
  It contains one table, the content of which is shown below.
</p>

<br><h6>users</h6><hr>

<!-- Bootstrap table to display the data in users -->
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Username</th>
      <th scope="col">E-mail</th>
      <th scope="col">Password hash</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM users";

    $result = mysqli_query($conn, $sql);
    // get the content of users as an associative array
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    // create and fill out a new row in the table for every row in users
    for ($x = 0; $x < count($rows); $x++) {
      $row = $rows[$x];
      echo '<tr>
        <th scope="row">'.$row['id'].'
        <td>'.$row['username'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['password'].'</td>
      </tr>';
    }
    ?>
  </tbody>
</table>

<?php mysqli_close($conn); ?>
