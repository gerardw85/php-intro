<?php
$page_title='Check Users - GW';
include ('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

require ('../mysqli_oop_connect.php');

$errors = array();

  if (empty($_POST['last_name'])) {
    $errors[] = 'You must enter a last name.';
  } else {
    $ln = $mysqli->real_escape_string(trim($_POST['last_name']));
  }

  if (empty($errors)) {
    $q = "SELECT CONCAT (last_name, ', ', first_name) AS name, user_id as uid FROM users WHERE last_name =('$ln')"; // Check Syntax!
    $r = $mysqli->query($q);

      echo "<h1>Your results are below:</h1>";

      echo '<table align="center" cellspacing="3" cellpadding="3" width="80%">
        <tr><td align="left"><b>Name</b></td>
        <td align="left"><b>User ID</b></td></tr>';

      while ($row = $r->fetch_object()) {
      echo '<tr><td align="left">' . $row->name . '</td><td align="left">' . $row->uid . '</td></tr>';
    }

      echo '</table>';
      $r->free();
      unset($r);

    $mysqli->close();
    unset($mysqli);
    include ('includes/footer.html');
    exit();

} else {
  echo '<h1>Oops.</h1><p class="error">The following error occured: <br />';
  foreach ($errors as $msg) {
    echo "$msg<br />\n";
    echo '</p>';
  }
}
}
?>

<h1>Lookup users by last name.</h1>
  <form action="check_users.php" method="post">

  <p>Last Name: <input type="text" name="last_name" size="15" maxlength="40"
      value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /> </p>

  <p><input type="submit" name="submit" value="Search" /> </p>
  </form>

  <?php include ('includes/footer.html'); ?>
