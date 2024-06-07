<?php 
session_start();
session_unset();
session_destroy();
header("Location: Pageaccueil.php");
exit();
?>
