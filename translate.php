<?php 
session_start(); 
if (!isset($_SESSION["username"]) || !isset($_SESSION["userEmail"]) || !isset($_SESSION["userLocale"])) {
  header("Location: login.php");
} else if (!isset($_GET["projectType"])) {
  header("Location: index.php");
}
?>
<html>
<head>
<title><?php echo "Welcome ".$_SESSION["username"]; ?></title>
<link rel="stylesheet" type="text/css" href="common/styles.css" />
<link rel="stylesheet" type="text/css" href="common/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
<script type="text/javascript" src="common/js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="common/js/jquery-ui-1.10.0.custom.min.js"></script>
<script type="text/javascript" src="common/js/common.js"></script>
<script type="text/javascript" src="common/js/jsonFormat.js"></script>
<script type="text/javascript" src="common/js/translateJSON.js"></script>
<script type="text/javascript" src="common/js/translateProperties.js"></script>
<script type="text/javascript">
var projectType = "<?php echo $_GET["projectType"]; ?>";
var currentLanguage = "<?php echo $_SESSION["userLocale"]; ?>";
$(document).ready(function() {

  View.prototype.i18n[View.prototype.i18n.defaultLocale] = {};
  View.prototype.retrieveLocale(View.prototype.i18n.defaultLocale,projectType);

  View.prototype.i18n[currentLanguage] = {};
  View.prototype.retrieveLocale(currentLanguage,projectType);

  buildTable(projectType);
  $("#heading").append(" ").append(projectType);
});

</script>
</head>
<body>
<span style="float:right"><a href="index.php">Go back to project select page</a> | <a href="logout.php">Logout</a></span>
<h1 id='heading'>WISE Translate: </h1>
<p>Send bug reports and questions to telsportal at gmail dot com.</p>
<div id="translationTableDiv">
</div>
</body>
</html>
