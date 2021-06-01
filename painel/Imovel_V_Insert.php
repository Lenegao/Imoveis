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

$Aux_idImovel = addslashes($_POST["idImovel"]);
$Aux_Titulo = addslashes($_POST["Titulo"]);
$Aux_Descricao = addslashes($_POST["Descricao"]);
$Aux_Observacoes = addslashes($_POST["Observacoes"]);
if (isset($_GET["idImovel"])) $Aux_idImovel = addslashes($_GET["idImovel"]);
if (isset($_GET["Titulo"])) $Aux_Titulo = addslashes($_GET["Titulo"]);
if (isset($_GET["Descricao"])) $Aux_Descricao = addslashes($_GET["Descricao"]);
if (isset($_GET["Observacoes"])) $Aux_Observacoes = addslashes($_GET["Observacoes"]);
?>

<form name='form1' method='POST' action='Imovel_Insert.php' >
<fieldset><legend class="C_field_legenda">Legenda Insert Imovel</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Titulo</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="45" size="45" name='Titulo' type='text' id='Titulo' value="<?php print $Aux_Titulo; ?>"></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Descricao</span></td>
    <td class='C_insert_celula_caixa'><textarea class='C_insert_textarea' name='Descricao' id='Descricao'><?php print $Aux_Descricao; ?></textarea></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Observacoes</span></td>
    <td class='C_insert_celula_caixa'><textarea class='C_insert_textarea' name='Observacoes' id='Observacoes'><?php print $Aux_Observacoes; ?></textarea></td>
  </tr>
  <tr class='C_insert_linha'><td class='C_insert_celula_envio' colspan='2'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value='sistema.php?pagina=Imovel_Visualizar.php'>
  </td></tr>
</table>
</fieldset>
</form>