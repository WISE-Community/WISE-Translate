<?php
include_once("common/defs.php");
session_start(); 
if (!isset($_SESSION["username"]) || !isset($_SESSION["userEmail"]) || !isset($_SESSION["userLocale"])) {
  header("Location: login.php");
}
if (isset($_GET["locale"]) && isset($_GET["projectType"]) ) {

  $filePath = "";
  $filename="";
  if ($_GET["projectType"] == "portal") {
      $filename = "i18n_".$_GET["locale"].".properties";
      $filePath = $translate_dir."/".$_GET["projectType"]."/i18n/$filename";
  } else {
      $filename = "i18n_".$_GET["locale"].".json";
      $filePath = $translate_dir."/".$_GET["projectType"]."/i18n/$filename";
  }
  $result = file_get_contents($filePath);
  header('Content-Type: text/plain');
  header("Content-Disposition: attachment;filename=$filename");
  echo $result;
} 

?>