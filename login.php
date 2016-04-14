<?php
  session_start(); 
  if (!empty($_POST["username"]) && !empty($_POST["userEmail"]) && !empty($_POST["userLocale"])) {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["userEmail"] = $_POST["userEmail"];
    $_SESSION["userLocale"] = $_POST["userLocale"];
    header("Location: index.php");
  } else {
  }
?>
<html>
<head>
<script type="text/javascript">
var supportedLocales = [ "en_US","zh_TW","zh_CN","nl","fr","de","he","it","ja","ko","pt","es","th","tr"];
</script>
<script type="text/javascript" src="common/js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="common/js/common.js"></script>
<script type="text/javascript">
function validateForm() {
  // validate username
  if ($("#username").val().length < 5) {
    alert("Please enter your name. Must be at least 5 characters");
    return false;
  }

  // validate email
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(!re.test($("#userEmail").val())) {
    alert("Invalid email address");
    return false;
  }

  // validate user locale
  if ($("#userLocaleSelect").val() == "") {
    alert("Please select a language");
    return false;
  }
  
  return true;
};

$(document).ready(function() {

// add supported locales to selectable drop-down list
for (var i=0; i<supportedLocales.length; i++) { 
    var supportedLocale = supportedLocales[i];
    if (supportedLocale != "en_US") {
        $("#userLocaleSelect").append("<option value='"+supportedLocale+"'>"+localeToHumanReadableLanguage(supportedLocale)+" ("+supportedLocale+") "+"</option>");
    }
};

// add option for new languages
$("#userLocaleSelect").append("<option id='otherLanguage'>Other...</option>");

$("#userLocaleSelect").change(function() {
  var idSelected = $(this).find("option:selected").attr("id");
  if (idSelected == "otherLanguage") {
    alert('Please post to the WISE Discussion Forum with your name and the language you\'d like to translate to.\n\nWe will add the language and let you know so you can start translating. Thanks!');
  }
});

});
</script>
<style type="text/css">
#loginDiv {
    width: 400px;
    height: 350px;
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
<h2 style="margin-top:0px">Log in to WISE Translation</h2>

  <p> Thanks for helping us translate WISE! You can use this site to translate the WISE student and teacher pages.<br/><br/>Please type in your name, email address, and choose the language that you want to translate to. If you don't see your language listed, or if you have any questions, please post to the <a href="https://wise-discuss.berkeley.edu/category/wise-in-other-languages">WISE Discussion Forum</a>.<br/><br/>We ask for your email so that we can contact you when we receive the translations and update WISE. We will never spam you.</p>
<form action="login.php" method="POST" onsubmit="return validateForm();">
  <table>
    <tr><td>Name:</td><td><input type="text" id="username" name="username" size="40"></input></td></tr>
    <tr><td>Email:</td><td><input type="text" id="userEmail" name="userEmail" size="40"></input></td></tr>
    <tr><td>Language:</td>
        <td>
            <select id="userLocaleSelect" name="userLocale">
	        <option value="">Choose a language...</option>
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
<script type="text/javascript">

  var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-789725-7']);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

</script>
</body>
</html>