<?php

unset($_SESSION["username"]);
unset($_SESSION["userEmail"]);
unset($_SESSION["userLocale"]);

header("Location: login.php");
?>