<?php # Script 3.5 - calculator.php
//Create radio button field.
 function create_radio($value, $name = 'gallon_price') {

    echo '<input type="radio" name="' . $name . '" value="' . $value . '"';

    if (isset($POST['$name']) && ($_POST['$name'] == $value)) {
      echo ' checked="checked"';
    }
    echo " /> $value ";
 }

//Calcuate the cost of the trip via function.
function calculate_trip_cost($miles, $mpg, $ppg) {
    $gallons = $miles/$mpg;
    $dollars = $gallons/$ppg;
    return number_format($dollars, 2);
  } //End of calculate_trip_cost() function.

$page_title = 'Trip Cost Calculator';
include ('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['distance'], $_POST['gallon_price'], $_POST['efficiency'])
  && is_numeric($_POST['distance']) && is_numeric($_POST['gallon_price']) &&
  is_numeric($_POST['efficiency']) ) {

    //Calculate the results:
    /*$gallons = $_POST['distance'] / $_POST['efficiency'];
    $dollars = $gallons * $_POST['gallon_price'];
    $hours = $_POST['distance']/65; */

    $cost = calculate_trip_cost
    ( $_POST['distance'],
      $_POST['efficiency'],
      $_POST['gallon_price']);
    $hours = $_POST['distance']/65;

    //Print the results of the calculation:
    echo '<h1>Total Estimated Cost</h1>
    <p>The total cost of driving ' . $_POST['distance'] . ' miles, averaging '
    . $_POST['efficiency'] . ' miles per gallon, and paying an average of $'
    . $_POST['gallon_price'] . ' per gallon, is $' . $cost .
    '. If you drive at an average of 65 miles per hour, the trip will take apprxoimately
    ' . number_format($hours, 2) . ' hours.</p>';

  } else { //Invalid submitted values.
  echo '<h1>Error!</h1> <p class="error">Please enter a valid distance, price
  per gallon, and fuel efficiency.</p>';
  }
} // End of main submission IF.
?>
<h1> Trip Cost Calculator</h1>
<form action="calculator.php" method="post">
  <p>Distance (in miles): <input type="text" name="distance" value="<?php if
    (isset($_POST['distance'])) { echo $_POST['distance']; } ?>" />
  </p>

<p> Ave. Price per Gallon: <span class="input">
<?php
  create_radio('1.00', 'gallon_price');
  create_radio('2.00', 'gallon_price');
  create_radio('3.00', 'gallon_price');
  ?>
</span></p>

<p>Fuel Efficiency: <select name="efficiency">
  <option value="10"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency']
    == '10')) echo ' selected="selected"'; ?>>Terrible </option>
  <option value="20"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency']
    == '20')) echo ' selected="selected"'; ?>>Decent </option>
  <option value="30"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency']
    == '30')) echo ' selected="selected"'; ?>>Very Good </option>
  <option value="50"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency']
    == '50')) echo ' selected="selected"'; ?>>Outstanding </option>
</select></p>
<p><input type="submit" name="submit" value="Calculate!" /> </p>
</form>

<?php include ('includes/footer.html'); ?>
