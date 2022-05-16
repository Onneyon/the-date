<h5>Overview</h5>
<p>
  These are all the backend elements of the website that are not exposed to the user.
</p>

<?php
  // get a list of pages to display the source for
  $pagelist = glob('logic/*.php');
  $language = 'php';
  require 'logic/displaysource.php';
