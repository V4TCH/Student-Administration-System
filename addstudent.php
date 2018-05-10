<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    if(isset($_POST['submit'])) {
        $safeid = mysqli_real_escape_string($conn, $_POST['txtstudentid']);
        $safepassword = mysqli_real_escape_string($conn, $_POST['txtpassword']);
        $safedob = mysqli_real_escape_string($conn, $_POST['txtdob']);
        $safefirstname = mysqli_real_escape_string($conn, $_POST['txtfirstname']);
        $safelastname = mysqli_real_escape_string($conn, $_POST['txtlastname']);
        $safehouse = mysqli_real_escape_string($conn, $_POST['txthouse']);
        $safetown = mysqli_real_escape_string($conn, $_POST['txttown']);
        $safecounty = mysqli_real_escape_string($conn, $_POST['txtcounty']);
        $safecountry = mysqli_real_escape_string($conn, $_POST['txtcountry']);
        $safepostcode = mysqli_real_escape_string($conn, $_POST['txtpostcode']);

        $sql = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`) VALUES (";
        $sql .= "'" . $safeid . "','" . password_hash($safepassword) . "','" . $safedob . "','" . $safefirstname . "','" . 
                      $safelastname . "','" . $safehouse . "','" . $safetown . "','" . $safecounty . "','" . $safecountry . "','" . $safepostcode . "'";
        $sql .= ");";

        if ($conn->query($sql) === TRUE) {
            echo "Successfully created record";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
   else {
    
    $data['content'] = <<<EOD

    <div class='container'>
    <h2>My Details</h2>
    <form class='form-horizontal' name="frmdetails" action="" method="post">
        <div class='form-group'>
            <label class='control-label col-sm-2'>Student ID:</label>
            <div class='col-sm-10'>
                <input class form-control name="txtstudentid" type="text" placeholder='Enter Student ID' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>Password:</label>
            <div class='col-sm-10'>
                <input class form-control name="txtpassword" type="text" placeholder='Enter Password' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>Date of birth:</label>
            <div class='col-sm-10'>
                <input class form-control name="txtdob" type="text" placeholder='Enter Date of Birth' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>First Name:</label>
            <div class='col-sm-10'>
                <input class form-control name="txtfirstname" type="text" placeholder='Enter First Name' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>Last Name</label>
            <div class='col-sm-10'>
                <input class form-control name="txtlastname" type="text" placeholder='Enter Last Name' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>House Name/Number</label>
            <div class='col-sm-10'>
                <input class form-control name="txthouse" type="text" placeholder='Enter House Name/Number' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>Town</label>
            <div class='col-sm-10'>
                <input class form-control name="txttown" type="text" placeholder='Enter Town' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>County</label>
            <div class='col-sm-10'>
                <input class form-control name="txtcounty" type="text" placeholder='Enter County' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>Country</label>
            <div class='col-sm-10'>
                <input class form-control name="txtcountry" type="text" placeholder='Enter Country' value="" />
                <br/>
            </div>
        </div>
        <div class='form-group'>
            <label class='control-label col-sm-2'>Postcode</label>
            <div class='col-sm-10'>
                <input class form-control name="txtpostcode" type="text" placeholder='Enter Postcode' value="" />
                <br/>
            </div>
        </div>
        <input type="submit" value="Save" name="submit" />
</div>
</form>
EOD;
   }
    echo template("templates/default.php", $data);
} else {
    header("Location: index.php");
}
echo template("templates/partials/footer.php");
?>