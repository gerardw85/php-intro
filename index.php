<?php # Script 3.4 - index.php

function create_ad() {
  echo '<p class="ad">Ths is an annoying ad!<p>';
} // End of create_ad function.

$page_title ='Welcome to this Site!';
include ('includes/header.html');
?>

<h1>Content Header</h1>

  <p> This is where the page-specific content goes. This section and the
    corresponding header, will change from one page to the next.</p>

  <p>Yada...yada...yada...</p>
  <?php create_ad();

    include ('includes/footer.html');

  ?>
