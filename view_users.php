<?php #Script 9.4 - view_users.php
$page_title = 'View the Current Users';
include ('includes/header.html');
echo '<h1>Regisered Users</h1>';

require ('../mysqli_oop_connect.php');
$q = "SELECT CONCAT(last_name, ', ', first_name) AS name, user_id AS uid, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users
      ORDER BY registration_date ASC";

$r = $mysqli->query($q);

//Count the number of returned rows.
$num_rows = $r->num_rows;

if ($num_rows > 0) { //Display the records.
  echo "<p>There are currently $num_rows registered users.</p>\n";

  echo '<table align="center" cellspacing="3" cellpadding="3" width="80%">
    <tr><td align="left"><b>Name</b></td>
    <td align="left"><b>User ID</b></td>
    <td align="left"><b>Date Registered</b></td></tr>';

    while ($row = $r->fetch_object()) {
    echo '<tr><td align="left">' . $row->name . '<td align="left">' . $row->uid . '</td><td align="left">' . $row->dr . '</td></tr>';
    }

      echo '</table>';
      $r->free();
      unset($r);

    } else {
      echo '<p class="error">There are currently no registered users.</p>';

    } //end of if ($r) IF.

$mysqli->close();
unset($mysqli);

include ('includes/footer.html');
?>
