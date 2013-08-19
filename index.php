<?php 
session_start(); 
if (!isset($_SESSION["username"]) || !isset($_SESSION["userEmail"])) {
  header("Location: login.php");
}
?>
<html>
<head>
<title><?= "Welcome ".$_SESSION["username"]; ?></title>
</head>
<body>
<h1>Welcome to the WISE4 Translation Project!</h1>
<p>If you need help, contact WISE staff (telsportal at gmail dot com)</p>

<h3><a href="vle">Translate the Virtual Learning Environment (VLE)</a></h3>
<p>The VLE includes the Student VLE, Authoring Tool, Grading Tool, and Researcher Tool.</p>
<br/>
<h3><a href="portal">Translate the Portal</a></h3>
<p>The WISE Portal is the user and classroom management system. This includes user registration and project and run management.</p>
</body>
</html>
