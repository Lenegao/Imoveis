<?php
session_start();
if ($_SESSION["S_autenticado"] != 'true') {
	print "<script> window.location.href = 'index.php'; </script>";
	exit();
}
$login = $_SESSION["S_login"];
?>