<link href="estilos.css" rel="stylesheet" type="text/css">


<script language='javascript' src="jscriador.js"></script>

<script>
function Confere() {
  if (!ConfereInteger("idEndereco", "'idEndereco_INTEGER'", '0')) return false;
  if (!ConfereInteger("idImovel", "'idImovel_INTEGER'", '0')) return false;
  if (!ConfereInteger("CEP", "'CEP_BIGINT'", '1')) return false;
  if (!ConfereInteger("Numero", "'Numero_INTEGER'", '1')) return false;
  return true;
  };
</script>

<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_idEndereco_Ant = addslashes($_GET["idEndereco"]);

$P_sql = "select idEndereco, idImovel, CEP, Numero, Complemento from Endereco
 where idEndereco = \"$Aux_idEndereco_Ant\"";

$resultado = mysql_query($P_sql,$P_Conexao);
$P_Linha_Aux = mysql_fetch_row($resultado);
//$P_Linha_Aux = mysql_fetch_assoc($resultado);

//$Aux_idEndereco = htmlentities($P_Linha_Aux["idEndereco"]);
//$Aux_idImovel = htmlentities($P_Linha_Aux["idImovel"]);
//$Aux_CEP = htmlentities($P_Linha_Aux["CEP"]);
//$Aux_Numero = htmlentities($P_Linha_Aux["Numero"]);
//$Aux_Complemento = htmlentities($P_Linha_Aux["Complemento"]);

$Aux_idEndereco = htmlentities($P_Linha_Aux[0]);
$Aux_idImovel = htmlentities($P_Linha_Aux[1]);
$Aux_CEP = htmlentities($P_Linha_Aux[2]);
$Aux_Numero = htmlentities($P_Linha_Aux[3]);
$Aux_Complemento = htmlentities($P_Linha_Aux[4]);



?>


<form name='form1' method='POST' enctype='multipart/form-data' action='Endereco_Update.php'>
<fieldset><legend class="C_field_legenda">Legenda Update Endereco</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idEndereco</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('INTEGER',this,event));" maxlength="9" name='idEndereco' type='text' id='idEndereco' value="<?php print $Aux_idEndereco; ?>"></td></tr>
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
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>CEP</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('BIGINT',this,event));" maxlength="20" name='CEP' type='text' id='CEP' value="<?php print $Aux_CEP; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Numero</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('INTEGER',this,event));" maxlength="9" name='Numero' type='text' id='Numero' value="<?php print $Aux_Numero; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Complemento</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="20" size="20" name='Complemento' type='text' id='Complemento' value="<?php print $Aux_Complemento; ?>"></td></tr>
  <tr class='C_insert_linha'><td colspan='2' class='C_insert_celula_envio'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value="<?php print $Aux_proxima_pagina;?>">
      <input type='hidden' name='idEndereco_Ant' value="<?php print "$Aux_idEndereco_Ant"; ?>">
  </td></tr>
</table>
</fieldset>
</form>

<input type='submit' name='Submit2' value='Voltar' class='clbotao' onclick="window.location.href='<?php print $_SESSION["proxima_pagina"]; ?>';">


