<?php
/* 
 * MENGHAPUS SESSION
 */
session_start();
$_SESSION = [];
session_unset();
session_destroy();

/* 
 * MENGHAPUS COOKIE
 */
setcookie("ussd", "", time() - 3600);
setcookie("key", "", time() - 3600);

header("Location: index.php");
exit;
