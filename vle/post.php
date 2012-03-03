<?php
$dir = "/Users/hirokiterashima/Sites/translate/WISE-Translate/vle/view/i18n/";
if (isset($_POST["locale"]) && isset($_POST["jsonStr"])) {
  $filePath = $dir."i18n_".$_POST["locale"].".json";
  echo file_put_contents($filePath,stripslashes($_POST["jsonStr"]));
  exit;

  // todo: call git functions via exec()
}

echo 'yo';
?>