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

$Aux_idCaracteristicas_Ant = addslashes($_GET["idCaracteristicas"]);
$Aux_idImovel_Ant = addslashes($_GET["idImovel"]);

$P_sql = "select idCaracteristicas, idImovel, ValorI, ValorD, ValorT from Caracteristicas_Imovel
 where idCaracteristicas = \"$Aux_idCaracteristicas_Ant\" and idImovel = \"$Aux_idImovel_Ant\"";

$resultado = mysql_query($P_sql,$P_Conexao);
$P_Linha_Aux = mysql_fetch_row($resultado);
//$P_Linha_Aux = mysql_fetch_assoc($resultado);

//$Aux_idCaracteristicas = htmlentities($P_Linha_Aux["idCaracteristicas"]);
//$Aux_idImovel = htmlentities($P_Linha_Aux["idImovel"]);
//$Aux_ValorI = htmlentities($P_Linha_Aux["ValorI"]);
//$Aux_ValorD = htmlentities($P_Linha_Aux["ValorD"]);
//$Aux_ValorT = htmlentities($P_Linha_Aux["ValorT"]);

$Aux_idCaracteristicas = htmlentities($P_Linha_Aux[0]);
$Aux_idImovel = htmlentities($P_Linha_Aux[1]);
$Aux_ValorI = htmlentities($P_Linha_Aux[2]);
$Aux_ValorD = htmlentities($P_Linha_Aux[3]);
$Aux_ValorT = htmlentities($P_Linha_Aux[4]);



?>


<form name='form1' method='POST' enctype='multipart/form-data' action='Caracteristicas_Imovel_Update.php'>
<fieldset><legend class="C_field_legenda">Legenda Update Caracteristicas_Imovel</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idCaracteristicas</span></td>
    <td class='C_insert_celula_caixa'>
    <select class='C_insert_text' name='idCaracteristicas_Sel' id='idCaracteristicas_Sel' onChange='document.getElementById("idCaracteristicas").value = this.value;'>
        <option selected value="0">0 --> Nao Selecionado</option>
        <?php
            $resultado = mysql_query("SELECT CONCAT(idCaracteristicas,' --> Caracteristicas: ',Nome), idCaracteristicas FROM Caracteristicas ORDER BY idCaracteristicas DESC LIMIT 0, 1000",$P_Conexao);
            if ($resultado != false)
              {
              $Linha_Aux = mysql_fetch_row($resultado);
              while ($Linha_Aux != false)
                {
                $Count_idCaracteristicas++;
                $P_Linha_Aux0 = substr($Linha_Aux[0], 0, 100);
                $P_Linha_Aux1 = $Linha_Aux[1];
                if ($P_Linha_Aux1 == $P_Linha_Aux[0])
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
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idImovel</span></td>
    <td class='C_insert_celula_caixa'>
    <select class='C_insert_text' name='idImovel_Sel' id='idImovel_Sel' onChange='document.getElementById("idImovel").value = this.value;'>
        <option selected value="0">0 --> Nao Selecionado</option>
        <?php
            $resultado = mysql_query("SELECT CONCAT(idImovel,' --> Imovel: ',Titulo), idImovel FROM Imovel ORDER BY idImovel DESC LIMIT 0, 1000",$P_Conexao);
            if ($resultado != false)
              {
              $Linha_Aux = mysql_fetch_row($resultado);
              while ($Linha_Aux != false)
                {
                $Count_idImovel++;
                $P_Linha_Aux0 = substr($Linha_Aux[0], 0, 100);
                $P_Linha_Aux1 = $Linha_Aux[1];
                if ($P_Linha_Aux1 == $P_Linha_Aux[1])
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
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>ValorI</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('INTEGER',this,event));" maxlength="9" name='ValorI' type='text' id='ValorI' value="<?php print $Aux_ValorI; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>ValorD</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('DECIMAL',this,event));" maxlength="9" name='ValorD' type='text' id='ValorD' value="<?php print $Aux_ValorD; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>ValorT</span></td>
    <td class='C_insert_celula_caixa'><textarea class='C_insert_textarea' name='ValorT' id='ValorT'><?php print $Aux_ValorT; ?></textarea></td>
  <tr class='C_insert_linha'><td colspan='2' class='C_insert_celula_envio'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value="<?php print $Aux_proxima_pagina;?>">
      <input type='hidden' name='idCaracteristicas_Ant' value="<?php print "$Aux_idCaracteristicas_Ant"; ?>">
      <input type='hidden' name='idImovel_Ant' value="<?php print "$Aux_idImovel_Ant"; ?>">
  </td></tr>
</table>
</fieldset>
</form>

<input type='submit' name='Submit2' value='Voltar' class='clbotao' onclick="window.location.href='<?php print $_SESSION["proxima_pagina"]; ?>';">


