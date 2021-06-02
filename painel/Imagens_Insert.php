
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


$Aux_LinkImagem = "\"".InsereArquivo(substr($Aux_LinkImagem,1,-1), 'LinkImagem', 'Imagens')."\"";
// Cria o link de Retorno
if (strpos($Aux_proxima_pagina,"?") === false) $Aux_proxima_pagina .= "?";
$Aux_proxima_pagina = IncluirUnico($Aux_proxima_pagina, "idImovel=", str_replace("\"", "", $Aux_idImovel));

// Retorna Nulo para os Campos com Insert de Referencia Vazios!
if ($Aux_idImovel == "\"\"" || $Aux_idImovel == "\"0\"") $Aux_idImovel = "null";

$sql = "Insert into Imagens ( idImovel, Titulo, Descricao, LinkImagem ) 
values ( $Aux_idImovel, $Aux_Titulo, $Aux_Descricao, $Aux_LinkImagem)";

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
<br>Não foi possível Cadastrar este usuário
<br>Clique em Voltar para Alterar o Cadastro!!!!