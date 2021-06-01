<link href="estilos.css" rel="stylesheet" type="text/css">
<script language='javascript' src="jscriador.js"></script>
<script>
function Confere() {
  if (!ConfereInteger("idImovel", "'idImovel_INTEGER'", '0')) return false;
  return true;
  };
</script>

<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_idImovel_Ant = addslashes($_GET["idImovel"]);

$P_sql = "select idImovel, Titulo, Descricao, Observacoes from Imovel
 where idImovel = \"$Aux_idImovel_Ant\"";

$resultado = mysql_query($P_sql,$P_Conexao);
$P_Linha_Aux = mysql_fetch_row($resultado);

$Aux_idImovel = htmlentities($P_Linha_Aux[0]);
$Aux_Titulo = htmlentities($P_Linha_Aux[1]);
$Aux_Descricao = htmlentities($P_Linha_Aux[2]);
$Aux_Observacoes = htmlentities($P_Linha_Aux[3]);
?>

<form name='form1' method='POST' enctype='multipart/form-data' action='Imovel_Update.php'>
<fieldset><legend class="C_field_legenda">Legenda Update Imovel</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idImovel</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('INTEGER',this,event));" maxlength="9" name='idImovel' type='text' id='idImovel' value="<?php print $Aux_idImovel; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Titulo</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="45" size="45" name='Titulo' type='text' id='Titulo' value="<?php print $Aux_Titulo; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Descricao</span></td>
    <td class='C_insert_celula_caixa'><textarea class='C_insert_textarea' name='Descricao' id='Descricao'><?php print $Aux_Descricao; ?></textarea></td>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Observacoes</span></td>
    <td class='C_insert_celula_caixa'><textarea class='C_insert_textarea' name='Observacoes' id='Observacoes'><?php print $Aux_Observacoes; ?></textarea></td>
  <tr class='C_insert_linha'><td colspan='2' class='C_insert_celula_envio'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value="<?php print $Aux_proxima_pagina;?>">
      <input type='hidden' name='idImovel_Ant' value="<?php print "$Aux_idImovel_Ant"; ?>">
  </td></tr>
</table>
</fieldset>
</form>
<input type='submit' name='Submit2' value='Voltar' class='clbotao' onclick="window.location.href='<?php print $_SESSION["proxima_pagina"]; ?>';">