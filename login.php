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
  "en_US","zh_TW","zh_CN","nl","de","he","it","ja","ko","es","tr"
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
<style type="text/css">
#loginDiv {
    width: 400px;
    height: 300px;
    background-color: #FFF9EF;
    padding:20px;

    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;

    margin: auto;

    border:2px solid;
    border-radius:25px;
}

table {
 margin-left:5px;
}

td { 
    padding: 2px;
}
</style>
</head>
<body>
<div id="loginDiv">
<h2>Log in to WISE Translation</h2>

<p> Please type in your name, email address, and choose the language that you want to translate to.<br/><br/>We ask for your email so that we can contact you when we receive the translations.</p>
<form action="login.php" method="POST">
  <table>
    <tr><td>Name:</td><td><input type="text" name="username" size="40"></input></td></tr>
    <tr><td>Email:</td><td><input type="text" name="userEmail" size="40"></input></td></tr>
    <tr><td>Language:</td>
        <td>
            <select id="userLocaleSelect" name="userLocale">
	        <option>Choose a language...</option>
            </select>
        </td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr><td></td><td><input type="submit" value="Log in"></input></td></tr>
  </table>
</form>
</div>
</body>
</html>