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


// Cria o link de Retorno
if (strpos($Aux_proxima_pagina,"?") === false) $Aux_proxima_pagina .= "?";
$Aux_proxima_pagina = IncluirUnico($Aux_proxima_pagina, "idCaracteristicas=", str_replace("\"", "", $Aux_idCaracteristicas));
$Aux_proxima_pagina = IncluirUnico($Aux_proxima_pagina, "idImovel=", str_replace("\"", "", $Aux_idImovel));

// Retorna Nulo para os Campos com Insert de Referencia Vazios!
if ($Aux_idCaracteristicas == "\"\"" || $Aux_idCaracteristicas == "\"0\"") $Aux_idCaracteristicas = "null";
if ($Aux_idImovel == "\"\"" || $Aux_idImovel == "\"0\"") $Aux_idImovel = "null";

$sql = "Insert into Caracteristicas_Imovel ( idCaracteristicas, idImovel, ValorI, ValorD, ValorT ) 
values ( $Aux_idCaracteristicas, $Aux_idImovel, $Aux_ValorI, $Aux_ValorD, $Aux_ValorT)";

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
<br>Não foi possível Cadastrar este usuário
<br>Clique em Voltar para Alterar o Cadastro!!!!