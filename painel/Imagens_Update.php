<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idImagens = "\"".addslashes($_POST["idImagens"])."\"";
$Aux_idImovel = "\"".addslashes($_POST["idImovel"])."\"";
$Aux_Titulo = "\"".trim(addslashes($_POST["Titulo"]))."\"";
$Aux_Descricao = "\"".addslashes($_POST["Descricao"])."\"";
$Aux_LinkImagem = "\"".addslashes($_POST["LinkImagem"])."\"";
$Aux_idImagens_Ant = "\"".addslashes($_POST["idImagens_Ant"])."\"";

// Retorna Nulo para os Campos com Insert de Referencia Vazios!
if ($Aux_idImovel == "\"\"" || $Aux_idImovel == "\"0\"") $Aux_idImovel = "null";

$P_sql = "select LinkImagem from Imagens where idImagens = $Aux_idImagens_Ant";
$resultado = mysql_query($P_sql,$P_Conexao);
$P_Linha_Aux = mysql_fetch_row($resultado);
    
$P_Aux_LinkImagem = addslashes($P_Linha_Aux[0]);
$Aux_LinkImagem = "\"".AtualizarArquivo($P_Aux_LinkImagem, substr($Aux_LinkImagem,1,-2), 'P_Nov_LinkImagem', 'Imagens')."\"";

$sql = "Update Imagens set idImagens = $Aux_idImagens, idImovel = $Aux_idImovel, Titulo = $Aux_Titulo, Descricao = $Aux_Descricao, LinkImagem = $Aux_LinkImagem
	where idImagens = $Aux_idImagens_Ant";

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