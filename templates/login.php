
<?php echo $message; ?>
<h1>Login</h1>
<form name="frmLogin" action="authenticate.php" method="post">
   Student ID:
   <input name="txtid" type="text" />
   <br/>
   Password:
   <input name="txtpwd" type="password" />
   <br/>
   <input type="submit" value="Login" name="btnlogin" />
</form>
