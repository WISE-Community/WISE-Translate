<?php
include_once("../defs.php");
if (isset($_POST["locale"]) && isset($_POST["jsonStr"])) {
  $filePath = $i18n_dir."i18n_".$_POST["locale"].".json";
  $jsonString = stripslashes($_POST["jsonStr"]);
  $result = file_put_contents($filePath,$jsonString);
  if ($result === FALSE) {
    echo "FAIL";
    exit;
  } else {
    // run exec to commit changes to github...ran into permission problems. can't do this, apparently.
    // so send email each time
    mail($adminEmail,"VLE translation locale: ".$_POST["locale"], $jsonString);
    exit;
  }
}
?>