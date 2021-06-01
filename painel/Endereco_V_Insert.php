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

$Aux_idEndereco = addslashes($_POST["idEndereco"]);
$Aux_idImovel = addslashes($_POST["idImovel"]);
$Aux_CEP = addslashes($_POST["CEP"]);
$Aux_Numero = addslashes($_POST["Numero"]);
$Aux_Complemento = addslashes($_POST["Complemento"]);
if (isset($_GET["idEndereco"])) $Aux_idEndereco = addslashes($_GET["idEndereco"]);
if (isset($_GET["idImovel"])) $Aux_idImovel = addslashes($_GET["idImovel"]);
if (isset($_GET["CEP"])) $Aux_CEP = addslashes($_GET["CEP"]);
if (isset($_GET["Numero"])) $Aux_Numero = addslashes($_GET["Numero"]);
if (isset($_GET["Complemento"])) $Aux_Complemento = addslashes($_GET["Complemento"]);

?>

<form name='form1' method='POST' action='Endereco_Insert.php' >

<fieldset><legend class="C_field_legenda">Legenda Insert Endereco</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idImovel</span></td>
    <td class='C_insert_celula_caixa'>
    <select class='C_insert_text' name='idImovel_Sel' id='idImovel_Sel' onChange='document.getElementById("idImovel").value = this.value;'>
        <option selected value='0'>0 --> Nao Selecionado</option>
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
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>CEP</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('BIGINT',this,event));" maxlength="20" name='CEP' type='text' id='CEP' value="<?php print $Aux_CEP; ?>"></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Numero</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('INTEGER',this,event));" maxlength="9" name='Numero' type='text' id='Numero' value="<?php print $Aux_Numero; ?>"></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Complemento</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="20" size="20" name='Complemento' type='text' id='Complemento' value="<?php print $Aux_Complemento; ?>"></td>
  </tr>
  <tr class='C_insert_linha'><td class='C_insert_celula_envio' colspan='2'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value='sistema.php?pagina=Endereco_Visualizar.php'>
  </td></tr>
</table>
</fieldset>
</form>


