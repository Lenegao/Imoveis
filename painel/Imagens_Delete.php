<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idImagens = addslashes($_GET["idImagens"]);

$resultado = mysql_query("select LinkImagem from Imagens where idImagens = \"$Aux_idImagens\"",$P_Conexao);
$Linha_Aux = mysql_fetch_row($resultado);
if (file_exists($Linha_Aux[0]))
	unlink($Linha_Aux[0]);

$sql = "delete from Imagens where idImagens = \"$Aux_idImagens\"";
$resultado = mysql_query($sql,$P_Conexao);

if ($resultado == true) {
	if (file_exists("Imagens_Finaliza.php"))
		include("Imagens_Finaliza.php");
	FBackup("Imagens", $sql, $P_Conexao);
	print "<script language=\"JavaScript\">window.location.href=\"$Aux_proxima_pagina\";</script>";
	exit();
} else {
	print "SQL: $sql <br>";
	print "Erro SQL:";
	print mysql_error();
}
?>