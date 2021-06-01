
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


// Cria o link de Retorno
if (strpos($Aux_proxima_pagina,"?") === false) $Aux_proxima_pagina .= "?";

// Retorna Nulo para os Campos com Insert de Referencia Vazios!

$sql = "Insert into Caracteristicas ( Nome, Conteudo, Tipo ) 
values ( $Aux_Nome, $Aux_Conteudo, $Aux_Tipo)";

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

<br>Não foi possível Cadastrar este usuário
<br>Clique em Voltar para Alterar o Cadastro!!!!
<form name='form1' method='POST' action='<?php print $Aux_proxima_pagina; ?>'>
<input type='hidden' name='idCaracteristicas' value="<?php print $Aux_idCaracteristicas; ?>">
<input type='hidden' name='Nome' value="<?php print $Aux_Nome; ?>">
<input type='hidden' name='Conteudo' value="<?php print $Aux_Conteudo; ?>">
<input type='hidden' name='Tipo' value="<?php print $Aux_Tipo; ?>">
<br> <input type='submit' name='Submit1' value='Voltar' class='clbotao'>
</form>



<link href="estilos.css" rel="stylesheet" type="text/css">


