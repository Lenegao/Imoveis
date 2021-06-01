<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idImovel = addslashes($_GET["idImovel"]);




$sql = "delete from Imovel where idImovel = \"$Aux_idImovel\"";
$resultado = mysql_query($sql,$P_Conexao);

if ($resultado == true)
  {
  if (file_exists("Imovel_Finaliza.php"))
    include("Imovel_Finaliza.php");
  FBackup("Imovel", $sql, $P_Conexao);
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


