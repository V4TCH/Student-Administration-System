<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");
    // check if student is logged in
    if (isset($_SESSION['id'])) {
        // check if checkbox is ticked
        if(isset($_POST['del_student_id'])) {
            // for each item that is checked, delete the record from the sql database
            foreach($_POST['del_student_id'] as $current) {
                $sql = "DELETE FROM student WHERE studentid=" . $current . ";";
                $result = mysqli_query($conn,$sql);
        }
    }
        echo template("templates/partials/header.php");
        echo template("templates/partials/nav.php");
        // selecting all from student table 
        $sql = "SELECT * FROM student;";
        $result = mysqli_query($conn,$sql);
      // prepare page content
      $data['content'] .= "<div class='container'> <form method='post' action=''>";
      $data['content'] .= "<table class='table' border='1'>";
      $data['content'] .= "<tr><th colspan='10' text-align='center'>Modules</th></tr>";
      $data['content'] .= "<tr><th>ID</th><th>DOB</th><th>Firstname</th><th>Lastname</th><th>House</th>
                           <th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Delete?</th></tr>";
      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "
         <tr><td>$row[studentid]</td><td>$row[dob]</td><td>$row[firstname]</td><td>$row[lastname]</td>
         <td>$row[house]</td><td>$row[town]</td><td>$row[county]</td>
         <td>$row[country]</td><td>$row[postcode]</td><td><input type='checkbox' name='del_student_id[]' value='$row[studentid]'></td>";
      }
      $data['content'] .= "</table>";
      $data['content'] .= "<input type='submit' value='Delete' name='Delete'></form></div>";
      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }
   echo template("templates/partials/footer.php");
?> 