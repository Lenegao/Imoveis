<?php
session_start();
$_SESSION["S_autenticado"]=false;
?>
<script> window.location.href = 'http://<?php print $_SERVER['SERVER_NAME']; ?>'; </script>
