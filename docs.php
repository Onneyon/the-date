<?php $page = 'docs'; require 'header.php'; ?>

<?php
  if (!isset($_GET['section']) || $_GET['section'] == '') {header('Location: /docs.php?section=0');}
  else {$_SESSION['docs-section'] = $_GET['section'];}
  if (!isset($_SESSION['docs-section'])) {$_SESSION['docs-section'] = $_GET['section'] ?? null;}

  $sections = glob('docs/*.php');
  $section = $_GET['section'] ?? null;

  if ($section < 0) {header('Location: /docs.php?section=0');}
  else if ($section >= count($sections)) {header('Location: /docs.php?section='.(count($sections) - 1));}

  $sectiontitles = array();

  for ($x = 0; $x < count($sections); $x++) {
    $sectiontitles[$x] = ucfirst(str_replace(array('docs/','.php'), '',$sections[$x]));
  }

  function addSectionLink ($state, $section, $title, $arialabel = null) {
    if (!is_null($arialabel)) {$arialabel = "aria-label='$arialabel'";}
    echo "<li class='page-item $state'><a class='page-link' href='/docs.php?section=$section'
    $arialabel>$title</a></li>";
  }
?>

<main>
  <div class="jumbotron text-center">
    <h1 class="display-3">THE DOCS</h1>
    <p class="lead">
      The code and testing process used to make this website.
    </p>
  </div>

  <div class="container">
    <nav aria-label="Documentation navigation">
      <ul class="pagination">
        <?php
          if ($section - 1 < 0) {$leftarrowstate = 'disabled';}
          else {$leftarrowstate = '';}
          if ($section + 1 >= count($sections)) {$rightarrowstate = 'disabled';}
          else {$rightarrowstate = '';}

          addSectionLink($leftarrowstate, ($section - 1), '<span aria-hidden="true">&laquo;</span>','Previous');

          for ($x = 0; $x < count($sections); $x++) {
            if ($section == $x) {$sectionstate = 'active';}
            else {$sectionstate = '';}
            addSectionLink($sectionstate, $x, $sectiontitles[$x]);
          }

          addSectionLink($rightarrowstate, ($section + 1), '<span aria-hidden="true">&raquo;</span>', 'Next');
        ?>
      </ul>
    </nav>

    <?php
      if ($section == "") {$section = 0;}
      require $sections[$section]; 
    ?>

  </div>
</main>

<?php require 'footer.php' ?>
