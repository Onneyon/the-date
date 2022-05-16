<h5>Overview</h5>
<p>
  These are all the frontend elements, or pages, of the website,
  including the sub-pages used for separate parts of this documentation.
</p>

<?php
  // get a list of pages to display the source for
  $pagelist = array_merge(glob('*.php'),glob('docs/*.php'));
  $language = 'php';
  require 'logic/displaysource.php';
