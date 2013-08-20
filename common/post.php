<?php
session_start();
include_once("defs.php");
if (empty($_SESSION["username"]) || empty($_SESSION["userEmail"])) {
  echo "FAIL";
  exit;
}

if (isset($_POST["locale"]) && isset($_POST["projectType"]) && isset($_POST["postStr"]) ) {
  // saves to file on the server
  
  if ($_POST["projectType"] == "portal") {
    $filePath = $translate_dir."/".$_POST["projectType"]."/i18n/"."ui-html_".$_POST["locale"].".properties";
    $contentString = $_POST["postStr"];
  } else  {
	    $filePath = $translate_dir."/".$_POST["projectType"]."/i18n/"."i18n_".$_POST["locale"].".json";
	    $contentString = $_POST["postStr"];
  }
  $result = file_put_contents($filePath,$contentString);
  if (!isset($adminEmail)) {
    $adminEmail = "telsportal@gmail.com";	
  }
  $today = date("F j, Y, g:i a");
  $emailContentString = "By: ".$_SESSION["username"]." Email: ".$_SESSION["userEmail"].$contentString;
  if ($result === FALSE) {
    mail($adminEmail, "[WISE TRANSLATION SAVE FAIL] ".$_POST["projectType"]." translation locale: ".$_POST["locale"], $emailContentString);
    mail($_SESSION["userEmail"], "[WISE TRANSLATION SAVE FAIL] ".$today, "WISE Staff has been notified ".$contentString);
    echo "FAIL";
    exit;
  } else {     
    // send email each time
    mail($adminEmail, "[WISE TRANSLATION SAVE SUCCESS] ".$_POST["projectType"].", ".$_POST["locale"], $emailContentString);
    mail($_SESSION["userEmail"], "Keep for backup: WISE translation ".$today, $contentString);
    exit;
  }
} else if (isset($_POST["locale"]) && isset($_POST["projectType"]) && isset($_POST["notifyComplete"])) {
  if (!isset($adminEmail)) { 
    $adminEmail = "telsportal@gmail.com";
  }
  mail($adminEmail, "Translation Complete for locale: ".$_POST["locale"]." project: ".$_POST["projectType"], "By: ".$_SESSION["username"]." Email: ".$_SESSION["userEmail"]);
}
?>