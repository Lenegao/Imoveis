<link href="estilos.css" rel="stylesheet" type="text/css">


<script language='javascript' src="jscriador.js"></script>

<script>
function Confere() {
  if (!ConfereInteger("idCaracteristicas", "'idCaracteristicas_INTEGER'", '0')) return false;
  return true;
  };
</script>

<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_idCaracteristicas_Ant = addslashes($_GET["idCaracteristicas"]);

$P_sql = "select idCaracteristicas, Nome, Conteudo, Tipo from Caracteristicas
 where idCaracteristicas = \"$Aux_idCaracteristicas_Ant\"";

$resultado = mysql_query($P_sql,$P_Conexao);
$P_Linha_Aux = mysql_fetch_row($resultado);
//$P_Linha_Aux = mysql_fetch_assoc($resultado);

//$Aux_idCaracteristicas = htmlentities($P_Linha_Aux["idCaracteristicas"]);
//$Aux_Nome = htmlentities($P_Linha_Aux["Nome"]);
//$Aux_Conteudo = htmlentities($P_Linha_Aux["Conteudo"]);
//$Aux_Tipo = htmlentities($P_Linha_Aux["Tipo"]);

$Aux_idCaracteristicas = htmlentities($P_Linha_Aux[0]);
$Aux_Nome = htmlentities($P_Linha_Aux[1]);
$Aux_Conteudo = htmlentities($P_Linha_Aux[2]);
$Aux_Tipo = htmlentities($P_Linha_Aux[3]);



?>


<form name='form1' method='POST' enctype='multipart/form-data' action='Caracteristicas_Update.php'>
<fieldset><legend class="C_field_legenda">Legenda Update Caracteristicas</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idCaracteristicas</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('INTEGER',this,event));" maxlength="9" name='idCaracteristicas' type='text' id='idCaracteristicas' value="<?php print $Aux_idCaracteristicas; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Nome</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="24" size="24" name='Nome' type='text' id='Nome' value="<?php print $Aux_Nome; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Conteudo</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="72" size="50" name='Conteudo' type='text' id='Conteudo' value="<?php print $Aux_Conteudo; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Tipo</span></td>
    <td class='C_insert_celula_caixa'><select class='C_insert_text' name='Tipo' id='Tipo'>
                                                          <option value="Inteiro" <?php if($Aux_Tipo=="Inteiro") print "selected"; ?> >Inteiro</option>
                                                          <option value="Decimal" <?php if($Aux_Tipo=="Decimal") print "selected"; ?> >Decimal</option>
                                                          <option value="Texto" <?php if($Aux_Tipo=="Texto") print "selected"; ?> >Texto</option>
    </select></td></tr>
  <tr class='C_insert_linha'><td colspan='2' class='C_insert_celula_envio'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value="<?php print $Aux_proxima_pagina;?>">
      <input type='hidden' name='idCaracteristicas_Ant' value="<?php print "$Aux_idCaracteristicas_Ant"; ?>">
  </td></tr>
</table>
</fieldset>
</form>

<input type='submit' name='Submit2' value='Voltar' class='clbotao' onclick="window.location.href='<?php print $_SESSION["proxima_pagina"]; ?>';">


