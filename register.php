<?php # Script 9.3 - register.php


$page_title='Register';
include ('includes/header.html');

// Checks for form submission.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require ('../mysqli_oop_connect.php'); //Connecting to the db.

  $errors = array(); //Initializes the errors array.

// Checks for the first name.
  if (empty($_POST['first_name'])) {
    $errors[] = 'You forgot to enter your first name.';
  } else {
    $fn = $mysqli->real_escape_string(trim($_POST['first_name'])); // -OOP method
    //$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name'])); // --The secure method.
    // $fn = trim($_POST['first_name']); --Not secure.
  }

// Checks for the last name.
  if (empty($_POST['last_name'])) {
    $errors[] = 'You forgot to enter your last name.';
  } else {
    $ln = $mysqli->real_escape_string(trim($_POST['last_name'])); // -OOP method.
    //$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name'])); // --The secure method.
    // $ln = trim($_POST['last_name']); --Not secure.
  }

// Checks for an email address.

  if (empty($_POST['email'])) {
  $errors[] = 'You forgot to enter your email.';
} else {
    $e = $mysqli->real_escape_string(trim($_POST['email'])); // -OOP method.
    //$e = mysqli_real_escape_string($dbc, trim($_POST['email'])); // --The secure method.
    // $e = trim($_POST['email']); --Not secure.
  }

//Check for a password and match against the confirm password.

  if (!empty($_POST['pass1'])) {
    if ($_POST['pass1'] != $_POST['pass2']) {
      $errors[] = 'Your password did not match the confirmed password.';
    } else {
      $p = $mysqli->real_escape_string(trim($_POST['pass1'])); //-OOP method.
      // $p = mysqli_real_escape_string($dbc, trim($_POST['pass1'])); // --The secure method.
      // $p = trim($_POST['pass1']); --Not secure.
      }
    } else {
      $errors[] = 'You forgot to enter your password.';
    }

    if (empty($errors)) { //If everything's ok.
        //Register the user in the db.

      //Query.

      $q = "INSERT INTO users (first_name, last_name, email, pass, registration_date)
      VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";

      $mysqli->query($q); // - Executes query.
      if ($mysqli->affected_rows == 1) { //If it ran ok


      // $r = @mysqli_query ($dbc, $q); //Run the query. - Procedural way.
      // if ($r) { //If it ran OK. - Procedural way.

        //Print a message.
        echo '<h1>Thank you!</h1><p>You are now registered. In Chapter 12
        you will actually be able to log in</p><p><br /></p>';
      } else { //If it did not run OK.

        //Public message:
        echo '<h1>System Error</h1><p class="error">You could not be registered
        due to a system error. We apologize for any inconvenience.</p>';

        //Debugging message.
        echo '<p>' . $mysqli->error . '<br /><br />Query: ' . $q . '</p>';
      } //End of if ($r) IF.

    $mysqli->close();  // -OOP method.
    unset($mysqli);
    // mysqli_close($dbc); //Close db connection.

      //Include the footer and quit the script.
      include ('includes/footer.html');
      exit();

    } else { //Report the errors.
      echo '<h1>Error!</h1><p class="error">The following error(s) occured:<br />';
      foreach ($errors as $msg) { //Print each error
        echo " - $msg<br />\n";
      }
      echo '</p><p>Plesae try again.</p><p><br /></p>';
    } // End of if (empty($errors)) IF.

    $mysqli->close();  // -OOP method.
    unset($mysqli);

    //mysqli_close($dbc);  // Close the DB connection.
  } //End of the main Submit Conditional.
  ?>

  <h1>Register</h1>
  <form action="register.php" method="post">

    <p>First Name: <input type="text" name="first_name" size="15" maxlength="20"
      value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /> </p>

    <p>Last Name: <input type="text" name="last_name" size="15" maxlength="40"
      value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /> </p>

    <p>Email Address: <input type="text" name="email" size="20" maxlength="60"
      value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /> </p>

    <p>Password: <input type="password" name="pass1" size="10" maxlength="20"
      value="<?php if(isset($_POST['pass1'])) echo $_POST['pass1']; ?>" /> </p>

    <p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20"
      value="<?php if(isset($_POST['pass2'])) echo $_POST['pass2']; ?>" /> </p>

    <p><input type="submit" name="submit" value="Register" /> </p>
  </form>
  <?php include ('includes/footer.html'); ?>
