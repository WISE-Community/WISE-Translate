<?php
$dir = "/Users/hirokiterashima/Sites/translate/WISE-Translate/vle/view/i18n/";
if (isset($_POST["locale"]) && isset($_POST["jsonStr"])) {
  $filePath = $dir."i18n_".$_POST["locale"].".json";
  $result = file_put_contents($filePath,stripslashes($_POST["jsonStr"]));
  if ($result === FALSE) {
    echo "FAIL";
    exit;
  } else {
    // run exec to commit changes to github
    exec("./commit.sh");
    exit;
  }
}
?>