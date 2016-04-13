<?php
session_start();
include_once("defs.php");
if (empty($_SESSION["username"]) || empty($_SESSION["userEmail"])) {
  echo "FAIL";
  exit;
}

if (isset($_POST["locale"]) && isset($_POST["projectType"]) && isset($_POST["postStr"]) ) {
  // saves to file on the server
  $locale = $_POST["locale"];
  $projectType = $_POST["projectType"];
  $contentString = $_POST["postStr"];
  $filePath = "";
  $filename = "i18n_".$locale.".json";
  if ($projectType == "common5") {
    $filePath = $translate_dir."/wise5/common/$filename";
  } else if ($projectType == "vle5") {
    $filePath = $translate_dir."/wise5/vle/$filename";
  } else if ($projectType == "authoringTool5") {
    $filePath = $translate_dir."/wise5/authoringTool/$filename";
  } else if ($projectType == "classroomMonitor5") {
    $filePath = $translate_dir."/wise5/classroomMonitor/$filename";
  } else if ($projectType == "portal") {
    $filePath = $translate_dir."/".$projectType."/i18n/"."i18n_".$locale.".properties";
  } else  {
    $filePath = $translate_dir."/".$projectType."/i18n/"."i18n_".$locale.".json";
  }
  $result = file_put_contents($filePath, $contentString);
  if (!isset($adminEmail)) {
    $adminEmail = "telsportal@gmail.com";	
  }
  $today = date("F j, Y, g:i a");
  $emailContentString = "By: ".$_SESSION["username"]." Email: ".$_SESSION["userEmail"].$contentString;
  if ($result === FALSE) {
    mail($adminEmail, "[WISE TRANSLATION SAVE FAIL] ".$projectType." translation locale: ".$locale, $emailContentString);
    mail($_SESSION["userEmail"], "[WISE TRANSLATION SAVE FAIL] ".$today, "WISE Staff has been notified ".$contentString);
    echo "FAIL";
    exit;
  } else {     
    // send email each time
    mail($adminEmail, "[WISE TRANSLATION SAVE SUCCESS] ".$projectType.", ".$locale, $emailContentString);
    mail($_SESSION["userEmail"], "Keep for backup: WISE translation ".$today, $contentString);
    exit;
  }
} else if (isset($locale) && isset($projectType) && isset($_POST["notifyComplete"])) {
  if (!isset($adminEmail)) { 
    $adminEmail = "telsportal@gmail.com";
  }
  mail($adminEmail, "Translation Complete for locale: ".$locale." project: ".$projectType, "By: ".$_SESSION["username"]." Email: ".$_SESSION["userEmail"]);
}
?>