
<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_proxima_pagina = $_SESSION["proxima_pagina"];
$Aux_idImovel = "\"".addslashes($_POST["idImovel"])."\"";
$Aux_Titulo = "\"".trim(addslashes($_POST["Titulo"]))."\"";
$Aux_Descricao = "\"".addslashes($_POST["Descricao"])."\"";
$Aux_Observacoes = "\"".addslashes($_POST["Observacoes"])."\"";


// Cria o link de Retorno
if (strpos($Aux_proxima_pagina,"?") === false) $Aux_proxima_pagina .= "?";

// Retorna Nulo para os Campos com Insert de Referencia Vazios!

$sql = "Insert into Imovel ( Titulo, Descricao, Observacoes ) 
values ( $Aux_Titulo, $Aux_Descricao, $Aux_Observacoes)";

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

<br>N�o foi poss�vel Cadastrar este usu�rio
<br>Clique em Voltar para Alterar o Cadastro!!!!
<form name='form1' method='POST' action='<?php print $Aux_proxima_pagina; ?>'>
<input type='hidden' name='idImovel' value="<?php print $Aux_idImovel; ?>">
<input type='hidden' name='Titulo' value="<?php print $Aux_Titulo; ?>">
<input type='hidden' name='Descricao' value="<?php print $Aux_Descricao; ?>">
<input type='hidden' name='Observacoes' value="<?php print $Aux_Observacoes; ?>">
<br> <input type='submit' name='Submit1' value='Voltar' class='clbotao'>
</form>



<link href="estilos.css" rel="stylesheet" type="text/css">


