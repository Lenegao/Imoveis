<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idCaracteristicas = addslashes($_GET["idCaracteristicas"]);




$sql = "delete from Caracteristicas where idCaracteristicas = \"$Aux_idCaracteristicas\"";
$resultado = mysql_query($sql,$P_Conexao);

if ($resultado == true)
  {
  if (file_exists("Caracteristicas_Finaliza.php"))
    include("Caracteristicas_Finaliza.php");
  FBackup("Caracteristicas", $sql, $P_Conexao);
  print "<script language=\"JavaScript\">window.location.href=\"$Aux_proxima_pagina\";</script>";
  exit();
  }
 else
  {
  print "SQL: $sql <br>";
  print "Erro SQL:";
  print mysql_error();
  }

?>


<link href="estilos.css" rel="stylesheet" type="text/css">


