<?php
  session_start(); 
  if (!empty($_POST["username"]) && !empty($_POST["userEmail"]) && !empty($_POST["userLocale"])) {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["userEmail"] = $_POST["userEmail"];
    $_SESSION["userLocale"] = $_POST["userLocale"];
    header("Location: index.php");
  }
?>
<html>
<head>
<script type="text/javascript" src="common/js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="common/js/common.js"></script>
<script type="text/javascript">
$(document).ready(function() {

var supportedLocales = [
  "en_US","zh_TW","zh_CN","nl","es","he","it","ja","ko"
];

// add supported locales to selectable drop-down list
for (var i=0; i<supportedLocales.length; i++) { 
    var supportedLocale = supportedLocales[i];
    if (supportedLocale != "en_US") {
        $("#userLocaleSelect").append("<option value='"+supportedLocale+"'>"+localeToHumanReadableLanguage(supportedLocale)+" ("+supportedLocale+") "+"</option>");
    }
};

});
</script>
</head>
<body>
<h2>Log In</h2>

<p> Please type in your name, email address, and the language that you want to translate to. We ask for your email so that we can contact you when we receive the translations.</p>
<form action="login.php" method="POST">
  <table>
    <tr><td>Name:</td><td><input type="text" name="username"></input></td></tr>
    <tr><td>Email:</td><td><input type="text" name="userEmail"></input></td></tr>
    <tr><td>Language:</td>
        <td>
            <select id="userLocaleSelect" name="userLocale">
	        <option>Choose a language...</option>
            </select>
        </td>
    </tr>
    <tr><td colspan="2"><input type="submit" value="Log in"></input></td></tr>
  </table>
</form>
</body>
</html>