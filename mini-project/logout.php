<?php
session_start();
session_destroy();
setcookie('email','',time()-(60));
header("location: login.php");
?>