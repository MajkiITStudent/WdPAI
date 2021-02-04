<?php
session_start();
$cookie_name = "name";
echo "Żegnaj ".$_COOKIE[$cookie_name]." !";
setcookie($cookie_name, "", time() - 900);
session_destroy();