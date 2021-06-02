<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idCaracteristicas = "\"".addslashes($_POST["idCaracteristicas"])."\"";
$Aux_idImovel = "\"".addslashes($_POST["idImovel"])."\"";
$Aux_ValorI = "\"".addslashes($_POST["ValorI"])."\"";
$Aux_ValorD = "\"".addslashes($_POST["ValorD"])."\"";
$Aux_ValorT = "\"".addslashes($_POST["ValorT"])."\"";
$Aux_idCaracteristicas_Ant = "\"".addslashes($_POST["idCaracteristicas_Ant"])."\"";
$Aux_idImovel_Ant = "\"".addslashes($_POST["idImovel_Ant"])."\"";

// Retorna Nulo para os Campos com Insert de Referencia Vazios!
if ($Aux_idCaracteristicas == "\"\"" || $Aux_idCaracteristicas == "\"0\"") $Aux_idCaracteristicas = "null";
if ($Aux_idImovel == "\"\"" || $Aux_idImovel == "\"0\"") $Aux_idImovel = "null";

$sql = "Update Caracteristicas_Imovel set idCaracteristicas = $Aux_idCaracteristicas, idImovel = $Aux_idImovel, ValorI = $Aux_ValorI, ValorD = $Aux_ValorD, ValorT = $Aux_ValorT
	where idCaracteristicas = $Aux_idCaracteristicas_Ant and idImovel = $Aux_idImovel_Ant";

$resultado = mysql_query($sql,$P_Conexao);
if ($resultado == true) {
	if (file_exists("Caracteristicas_Imovel_Finaliza.php"))
		include("Caracteristicas_Imovel_Finaliza.php");
	FBackup("Caracteristicas_Imovel", $sql, $P_Conexao);
	print "<script language=\"JavaScript\">window.location.href=\"$Aux_proxima_pagina\";</script>";
	exit();
} else {
	print "SQL: $sql <br>";
	print "Erro SQL:";
	print mysql_error();
}
?>