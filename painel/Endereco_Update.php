
<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idEndereco = "\"".addslashes($_POST["idEndereco"])."\"";
$Aux_idImovel = "\"".addslashes($_POST["idImovel"])."\"";
$Aux_CEP = "\"".addslashes($_POST["CEP"])."\"";
$Aux_Numero = "\"".addslashes($_POST["Numero"])."\"";
$Aux_Complemento = "\"".trim(addslashes($_POST["Complemento"]))."\"";
$Aux_idEndereco_Ant = "\"".addslashes($_POST["idEndereco_Ant"])."\"";


// Retorna Nulo para os Campos com Insert de Referencia Vazios!
if ($Aux_idImovel == "\"\"" || $Aux_idImovel == "\"0\"") $Aux_idImovel = "null";





$sql = "Update Endereco set idEndereco = $Aux_idEndereco, idImovel = $Aux_idImovel, CEP = $Aux_CEP, Numero = $Aux_Numero, Complemento = $Aux_Complemento
 where idEndereco = $Aux_idEndereco_Ant";

$resultado = mysql_query($sql,$P_Conexao);

if ($resultado == true)
  {
  if (file_exists("Endereco_Finaliza.php"))
    include("Endereco_Finaliza.php");
  FBackup("Endereco", $sql, $P_Conexao);
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


