<!DOCTYPE html PUBLIC "-//W3C//
    DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://wwww.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
    <title>Calendar</title>
    </head>
    <body> 
    <form action="calendar.php" method="post">
    <?php # Script 2.6 - calendar.php #4
    
    //Create the months array. 
    $months = array (1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July'
    ,'August', 'September', 'October', 'November', 'December');
    
    //Create the months drop down menu.
    echo '<select name="month">';
        foreach ($months as $key => $value) {
        echo "<option value=\"$key\">
             $value</option>\n";
             }
             echo '</select>';
    
    
    echo '<select name="day">';
         for ($day = 1; $day <= 31; $day++) {
         echo "<option value=\"$day\">
         $day</option>\n";
       
         }    
            echo '</select>';

    echo '<select name="year">';
       for ($year = 2011; $year <=2021; $year++) {
       echo "<option value=\"$year\">
       $year</option>\n";
       }
            echo '</select>';

    
    ?>
    </form>
    </body>
    </html> 