
<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idCaracteristicas = "\"".addslashes($_POST["idCaracteristicas"])."\"";
$Aux_Nome = "\"".trim(addslashes($_POST["Nome"]))."\"";
$Aux_Conteudo = "\"".trim(addslashes($_POST["Conteudo"]))."\"";
$Aux_Tipo = "\"".addslashes($_POST["Tipo"])."\"";
$Aux_idCaracteristicas_Ant = "\"".addslashes($_POST["idCaracteristicas_Ant"])."\"";


// Retorna Nulo para os Campos com Insert de Referencia Vazios!





$sql = "Update Caracteristicas set idCaracteristicas = $Aux_idCaracteristicas, Nome = $Aux_Nome, Conteudo = $Aux_Conteudo, Tipo = $Aux_Tipo
 where idCaracteristicas = $Aux_idCaracteristicas_Ant";

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


