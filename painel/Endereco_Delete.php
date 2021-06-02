<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idEndereco = addslashes($_GET["idEndereco"]);

$sql = "delete from Endereco where idEndereco = \"$Aux_idEndereco\"";
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