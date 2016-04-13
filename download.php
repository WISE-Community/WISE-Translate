<?php
include_once("common/defs.php");
session_start(); 
if (!isset($_SESSION["username"]) || !isset($_SESSION["userEmail"]) || !isset($_SESSION["userLocale"])) {
  header("Location: login.php");
}
if (isset($_GET["locale"]) && isset($_GET["projectType"]) ) {

  $locale = $_GET["locale"];
  $projectType = $_GET["projectType"];
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
      $filename = "i18n_".$locale.".properties";
      $filePath = $translate_dir."/".$projectType."/i18n/$filename";
  } else {
      $filename = "i18n_".$locale.".json";
      $filePath = $translate_dir."/".$projectType."/i18n/$filename";
  }
  $result = file_get_contents($filePath);
  header('Content-Type: text/plain');
  header("Content-Disposition: attachment;filename=$filename");
  echo $result;
} 

?>