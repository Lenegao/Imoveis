<link href="estilos.css" rel="stylesheet" type="text/css">


<script language='javascript' src="jscriador.js"></script>

<script>
function Confere() {
  if (!ConfereInteger("idCaracteristicas", "'idCaracteristicas_INTEGER'", '0')) return false;
  if (!ConfereInteger("idImovel", "'idImovel_INTEGER'", '0')) return false;
  if (!ConfereInteger("ValorI", "'ValorI_INTEGER'", '1')) return false;
  if (!ConfereFloat("ValorD", "'ValorD_DECIMAL'", '1')) return false;
  return true;
  };
</script>

<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_idCaracteristicas = addslashes($_POST["idCaracteristicas"]);
$Aux_idImovel = addslashes($_POST["idImovel"]);
$Aux_ValorI = addslashes($_POST["ValorI"]);
$Aux_ValorD = addslashes($_POST["ValorD"]);
$Aux_ValorT = addslashes($_POST["ValorT"]);
if (isset($_GET["idCaracteristicas"])) $Aux_idCaracteristicas = addslashes($_GET["idCaracteristicas"]);
if (isset($_GET["idImovel"])) $Aux_idImovel = addslashes($_GET["idImovel"]);
if (isset($_GET["ValorI"])) $Aux_ValorI = addslashes($_GET["ValorI"]);
if (isset($_GET["ValorD"])) $Aux_ValorD = addslashes($_GET["ValorD"]);
if (isset($_GET["ValorT"])) $Aux_ValorT = addslashes($_GET["ValorT"]);

?>

<form name='form1' method='POST' action='Caracteristicas_Imovel_Insert.php' >

<fieldset><legend class="C_field_legenda">Legenda Insert Caracteristicas_Imovel</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idCaracteristicas</span></td>
    <td class='C_insert_celula_caixa'>
    <select class='C_insert_text' name='idCaracteristicas_Sel' id='idCaracteristicas_Sel' onChange='document.getElementById("idCaracteristicas").value = this.value;'>
        <option selected value='0'>0 --> Nao Selecionado</option>
        <?php
		$resultado = mysql_query("SELECT CONCAT(idCaracteristicas,' --> Caracteristicas: ',Nome), idCaracteristicas FROM Caracteristicas ORDER BY idCaracteristicas DESC LIMIT 0, 1000",$P_Conexao);
		if ($resultado != false) {
			$Linha_Aux = mysql_fetch_row($resultado);
			while ($Linha_Aux != false) {
				$Count_idCaracteristicas++;
				$P_Linha_Aux0 = substr($Linha_Aux[0], 0, 100);
				$P_Linha_Aux1 = $Linha_Aux[1];
				if ($P_Linha_Aux1 == $Aux_idCaracteristicas)
					print "      <option selected value='$P_Linha_Aux1'>$P_Linha_Aux0</option>";
				else
					print "      <option value='$P_Linha_Aux1'>$P_Linha_Aux0</option>";
				$Linha_Aux = mysql_fetch_row($resultado);
			}
		}
          
        ?>
      </select>
      <input name='idCaracteristicas' type='<?php if ($Count_idCaracteristicas > 900) print "text"; else print "hidden"; ?>' id='idCaracteristicas' value='<?php print $Aux_idCaracteristicas; ?>' size='14' maxlength='12'>
    </td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idImovel</span></td>
    <td class='C_insert_celula_caixa'>
    <select class='C_insert_text' name='idImovel_Sel' id='idImovel_Sel' onChange='document.getElementById("idImovel").value = this.value;'>
        <option selected value='0'>0 --> Nao Selecionado</option>
        <?php
		$resultado = mysql_query("SELECT CONCAT(idImovel,' --> Imovel: ',Titulo), idImovel FROM Imovel ORDER BY idImovel DESC LIMIT 0, 1000",$P_Conexao);
		if ($resultado != false) {
			$Linha_Aux = mysql_fetch_row($resultado);
			while ($Linha_Aux != false) {
				$Count_idImovel++;
				$P_Linha_Aux0 = substr($Linha_Aux[0], 0, 100);
				$P_Linha_Aux1 = $Linha_Aux[1];
				if ($P_Linha_Aux1 == $Aux_idImovel)
					print "      <option selected value='$P_Linha_Aux1'>$P_Linha_Aux0</option>";
				else
					print "      <option value='$P_Linha_Aux1'>$P_Linha_Aux0</option>";
				$Linha_Aux = mysql_fetch_row($resultado);
			}
		}
        ?>
      </select>
      <input name='idImovel' type='<?php if ($Count_idImovel > 900) print "text"; else print "hidden"; ?>' id='idImovel' value='<?php print $Aux_idImovel; ?>' size='14' maxlength='12'>
    </td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>ValorI</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('INTEGER',this,event));" maxlength="9" name='ValorI' type='text' id='ValorI' value="<?php print $Aux_ValorI; ?>"></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>ValorD</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('DECIMAL',this,event));" maxlength="9" name='ValorD' type='text' id='ValorD' value="<?php print $Aux_ValorD; ?>"></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>ValorT</span></td>
    <td class='C_insert_celula_caixa'><textarea class='C_insert_textarea' name='ValorT' id='ValorT'><?php print $Aux_ValorT; ?></textarea></td>
  </tr>
  <tr class='C_insert_linha'><td class='C_insert_celula_envio' colspan='2'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value='sistema.php?pagina=Caracteristicas_Imovel_Visualizar.php'>
  </td></tr>
</table>
</fieldset>
</form>