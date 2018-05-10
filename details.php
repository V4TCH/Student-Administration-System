<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      $safefirstname = mysqli_real_escape_string($conn, $_POST['txtfirstname']);
      $safelastname = mysqli_real_escape_string($conn, $_POST['txtlastname']);
      $safehouse = mysqli_real_escape_string($conn, $_POST['txthouse']);
      $safetown = mysqli_real_escape_string($conn, $_POST['txttown']);
      $safecounty = mysqli_real_escape_string($conn, $_POST['txtcounty']);
      $safecountry = mysqli_real_escape_string($conn, $_POST['txtcountry']);
      $safepostcode = mysqli_real_escape_string($conn, $_POST['txtpostcode']);
      $safeid = mysqli_real_escape_string($conn, $_POST['id']);
      // build an sql statment to update the student details
      $sql = "update student set firstname ='" . $safefirstname . "',";
      $sql .= "lastname ='" . $safelastname  . "',";
      $sql .= "house ='" . $safehouse  . "',";
      $sql .= "town ='" . $safetown  . "',";
      $sql .= "county ='" . $safecounty  . "',";
      $sql .= "country ='" . $safecountry  . "',";
      $sql .= "postcode ='" . $safepostcode  . "' ";
      $sql .= "where studentid = '" . $safeid . "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>";

   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <div class='container'>
   <h2>My Details</h2>
   <form class='form-horizontal' name="frmdetails" action="" method="post">
       <div class='form-group'>
           <label class='control-label col-sm-2'>Student ID:</label>
           <div class='col-sm-10'>
               <input class form-control name="txtstudentid" type="text" value="$row[studentid]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>Password:</label>
           <div class='col-sm-10'>
               <input class form-control name="txtstudentid" type="text" value="$row[password]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>Date of birth:</label>
           <div class='col-sm-10'>
               <input class form-control name="txtdob" type="text" value="$row[dob]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>First Name:</label>
           <div class='col-sm-10'>
               <input class form-control name="txtfirstname" type="text" value="$row[firstname]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>Last Name</label>
           <div class='col-sm-10'>
               <input class form-control name="txtlastname" type="text" value="$row[lastname]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>House Name/Number</label>
           <div class='col-sm-10'>
               <input class form-control name="txthouse" type="text" value="$row[house]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>Town</label>
           <div class='col-sm-10'>
               <input class form-control name="txttown" type="text"  value="$row[town]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>County</label>
           <div class='col-sm-10'>
               <input class form-control name="txtcounty" type="text"  value="$row[county]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>Country</label>
           <div class='col-sm-10'>
               <input class form-control name="txtcountry" type="text" value="$row[country]" />
               <br/>
           </div>
       </div>
       <div class='form-group'>
           <label class='control-label col-sm-2'>Postcode</label>
           <div class='col-sm-10'>
               <input class form-control name="txtpostcode" type="text" value="$row[postcode]" />
               <br/>
           </div>
       </div>
       <input type="submit" value="Save" name="submit" />
</div>
</form>
EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
