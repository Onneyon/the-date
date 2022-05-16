<?php
  for ($x=0; $x < count($pagelist); $x++) {
    // open every file in the array
    $filename = $pagelist[$x];
    $file = fopen($filename, 'r') or die('Couldn\'t open '.$filename);
    // sanitise the source to avoid HTML tags being parsed
    $filetext = htmlspecialchars(fread($file,filesize($filename)));
    // display a code block formatted with Prism based on the language set
    echo "<br><h6>".$filename."<hr></h6><pre><code class='line-numbers
    language-".$language."'>".$filetext."</code></pre>";
    fclose($file);
  }
