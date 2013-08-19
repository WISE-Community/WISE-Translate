<?php
  session_start(); 
  if (!empty($_POST["username"]) && !empty($_POST["userEmail"])) {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["userEmail"] = $_POST["userEmail"];
    header("Location: index.php");
  }
?>
<h2>Log In</h2>
<p> Please Type in your name and email address. This is so that we can contact you when we receive the translations.</p>
<form action="login.php" method="POST">
  <table>
    <tr><td>Name:</td><td><input type="text" name="username"></input></td></tr>
    <tr><td>Email:</td><td><input type="text" name="userEmail"></input></td></tr>
    <tr><td colspan="2"><input type="submit" value="Done"></input></td></tr>
  </table>
</form>