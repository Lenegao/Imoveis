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

// Cria o link de Retorno
if (strpos($Aux_proxima_pagina,"?") === false) $Aux_proxima_pagina .= "?";
$Aux_proxima_pagina = IncluirUnico($Aux_proxima_pagina, "idImovel=", str_replace("\"", "", $Aux_idImovel));

// Retorna Nulo para os Campos com Insert de Referencia Vazios!
if ($Aux_idImovel == "\"\"" || $Aux_idImovel == "\"0\"") $Aux_idImovel = "null";

$sql = "Insert into Endereco ( idImovel, CEP, Numero, Complemento ) 
values ( $Aux_idImovel, $Aux_CEP, $Aux_Numero, $Aux_Complemento)";

$resultado = mysql_query($sql,$P_Conexao);

if ($resultado == true) {
	if (file_exists("Endereco_Finaliza.php"))
		include("Endereco_Finaliza.php");
	FBackup("Endereco", $sql, $P_Conexao);
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