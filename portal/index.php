<?php 
session_start(); 
if (!isset($_SESSION["username"]) || !isset($_SESSION["userEmail"])) {
  header("Location: ../login.php");
}
?>
<html>
<head>
<title><?= "Welcome ".$_SESSION["username"]; ?></title>
<link rel="stylesheet" type="text/css" href="../common/styles.css" />
<link rel="stylesheet" type="text/css" href="../common/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
<script type="text/javascript" src="../common/js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="../common/js/jquery-ui-1.10.0.custom.min.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<script type="text/javascript" src="js/translate.js"></script>

</head>
<body>
<h1>WISE Translate: Portal</h1>
<p>Send bug reports and questions to telsportal at gmail dot com.</p>
<div id="defaultLocale">Default Locale: </div>
<div id="currentLanguage">Currently Translating: 
<select id="currentLanguageSelect">
<option>Choose a language...</option>
</select>
</div>

<div id="translationTableDiv">
</div>
</body>
</html>
