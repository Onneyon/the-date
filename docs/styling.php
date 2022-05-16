<h5>Overview</h5>
<p>
  This site uses <a href="https://getbootstrap.com/">Bootstrap</a> for most of the styling,
  <a href="https://fonts.google.com/">Google Fonts</a> to provide the Montserrat font used for headings,
  and <a href="https://prismjs.com/">Prism</a> for the syntax-highlighted code blocks.
  <code>main.css</code> is very small as its only purpose is to apply the custom font.
</p>

<?php
  $pagelist = glob('style/*.css');

  // hide the Prism CSS file because I didn't write it so you don't need to see it
  for ($x=0; $x < count($pagelist); $x++) {
    if ($pagelist[$x] == 'style/prism.css') {
      unset($pagelist[$x]);
      $pagelist = array_values($pagelist);
    }
  }

  $language = 'css';
  require 'logic/displaysource.php';
