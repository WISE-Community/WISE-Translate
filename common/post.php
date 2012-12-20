<?php
include_once("../defs.php");
if (isset($_POST["locale"]) && isset($_POST["projectType"]) && $_POST["projectType"] == "vle" && isset($_POST["postStr"]) ) {
  // saves to file on the server
  $filePath = $i18n_dir."i18n_".$_POST["locale"].".json";
  $jsonString = stripslashes($_POST["postStr"]);
  $result = file_put_contents($filePath,$jsonString);
  if ($result === FALSE) {
    echo "FAIL";
    exit;
  } else {
    // run exec to commit changes to github...ran into permission problems. can't do this, apparently.
    // so send email each time
    if (!isset($adminEmail)) {
	  $adminEmail = "telsportal@gmail.com";	
    }
	mail($adminEmail,"VLE translation locale: ".$_POST["locale"], $jsonString);
    exit;
  }
}
?>