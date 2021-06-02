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

$Aux_idCaracteristicas = addslashes($_POST["idCaracteristicas"]);
$Aux_Nome = addslashes($_POST["Nome"]);
$Aux_Conteudo = addslashes($_POST["Conteudo"]);
$Aux_Tipo = addslashes($_POST["Tipo"]);
if (isset($_GET["idCaracteristicas"])) $Aux_idCaracteristicas = addslashes($_GET["idCaracteristicas"]);
if (isset($_GET["Nome"])) $Aux_Nome = addslashes($_GET["Nome"]);
if (isset($_GET["Conteudo"])) $Aux_Conteudo = addslashes($_GET["Conteudo"]);
if (isset($_GET["Tipo"])) $Aux_Tipo = addslashes($_GET["Tipo"]);

?>

<form name='form1' method='POST' action='Caracteristicas_Insert.php' >

<fieldset><legend class="C_field_legenda">Legenda Insert Caracteristicas</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Nome</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="24" size="24" name='Nome' type='text' id='Nome' value="<?php print $Aux_Nome; ?>"></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Conteudo</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="72" size="50" name='Conteudo' type='text' id='Conteudo' value="<?php print $Aux_Conteudo; ?>"></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Tipo</span></td>
    <td class='C_insert_celula_caixa'><select class='C_insert_text' name='Tipo' id='Tipo'>
                                                          <option value="Inteiro" <?php if($Aux_Tipo=="Inteiro") print "selected"; ?> >Inteiro</option>
                                                          <option value="Decimal" <?php if($Aux_Tipo=="Decimal") print "selected"; ?> >Decimal</option>
                                                          <option value="Texto" <?php if($Aux_Tipo=="Texto") print "selected"; ?> >Texto</option>
    </select></td>
  </tr>
  <tr class='C_insert_linha'><td class='C_insert_celula_envio' colspan='2'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value='sistema.php?pagina=Caracteristicas_Visualizar.php'>
  </td></tr>
</table>
</fieldset>
</form>


