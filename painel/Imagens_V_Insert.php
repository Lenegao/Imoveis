<link href="estilos.css" rel="stylesheet" type="text/css">


<script language='javascript' src="jscriador.js"></script>

<script>
function Confere() {
  if (!ConfereInteger("idImagens", "'idImagens_INTEGER'", '0')) return false;
  if (!ConfereInteger("idImovel", "'idImovel_INTEGER'", '0')) return false;
  return true;
  };
</script>

<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

$Aux_idImagens = addslashes($_POST["idImagens"]);
$Aux_idImovel = addslashes($_POST["idImovel"]);
$Aux_Titulo = addslashes($_POST["Titulo"]);
$Aux_Descricao = addslashes($_POST["Descricao"]);
$Aux_LinkImagem = addslashes($_POST["LinkImagem"]);
if (isset($_GET["idImagens"])) $Aux_idImagens = addslashes($_GET["idImagens"]);
if (isset($_GET["idImovel"])) $Aux_idImovel = addslashes($_GET["idImovel"]);
if (isset($_GET["Titulo"])) $Aux_Titulo = addslashes($_GET["Titulo"]);
if (isset($_GET["Descricao"])) $Aux_Descricao = addslashes($_GET["Descricao"]);
if (isset($_GET["LinkImagem"])) $Aux_LinkImagem = addslashes($_GET["LinkImagem"]);

?>

<form name='form1' method='POST' action='Imagens_Insert.php' enctype='multipart/form-data'>

<fieldset><legend class="C_field_legenda">Legenda Insert Imagens</legend>
<table class='C_insert_tabela'>
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
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Titulo</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="48" size="48" name='Titulo' type='text' id='Titulo' value="<?php print $Aux_Titulo; ?>"></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Descricao</span></td>
    <td class='C_insert_celula_caixa'><textarea class='C_insert_textarea' name='Descricao' id='Descricao'><?php print $Aux_Descricao; ?></textarea></td>
  </tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>LinkImagem</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('0',this,event));"  name='LinkImagem' type='file' id='LinkImagem' value="<?php print $Aux_LinkImagem; ?>"></td>
  </tr>
  <tr class='C_insert_linha'><td class='C_insert_celula_envio' colspan='2'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value='sistema.php?pagina=Imagens_Visualizar.php'>
  </td></tr>
</table>
</fieldset>
</form>


