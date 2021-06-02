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

$Aux_idImagens_Ant = addslashes($_GET["idImagens"]);

$P_sql = "select idImagens, idImovel, Titulo, Descricao, LinkImagem from Imagens
 where idImagens = \"$Aux_idImagens_Ant\"";

$resultado = mysql_query($P_sql,$P_Conexao);
$P_Linha_Aux = mysql_fetch_row($resultado);
//$P_Linha_Aux = mysql_fetch_assoc($resultado);

//$Aux_idImagens = htmlentities($P_Linha_Aux["idImagens"]);
//$Aux_idImovel = htmlentities($P_Linha_Aux["idImovel"]);
//$Aux_Titulo = htmlentities($P_Linha_Aux["Titulo"]);
//$Aux_Descricao = htmlentities($P_Linha_Aux["Descricao"]);
//$Aux_LinkImagem = htmlentities($P_Linha_Aux["LinkImagem"]);

$Aux_idImagens = htmlentities($P_Linha_Aux[0]);
$Aux_idImovel = htmlentities($P_Linha_Aux[1]);
$Aux_Titulo = htmlentities($P_Linha_Aux[2]);
$Aux_Descricao = htmlentities($P_Linha_Aux[3]);
$Aux_LinkImagem = htmlentities($P_Linha_Aux[4]);
$Aux_P_LinkImagem = htmlentities(tirabarraponto($P_Linha_Aux[4]));



?>


<form name='form1' method='POST' enctype='multipart/form-data' action='Imagens_Update.php'>
<fieldset><legend class="C_field_legenda">Legenda Update Imagens</legend>
<table class='C_insert_tabela'>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>idImagens</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('INTEGER',this,event));" maxlength="9" name='idImagens' type='text' id='idImagens' value="<?php print $Aux_idImagens; ?>"></td></tr>
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
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Titulo</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' maxlength="48" size="48" name='Titulo' type='text' id='Titulo' value="<?php print $Aux_Titulo; ?>"></td></tr>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>Descricao</span></td>
    <td class='C_insert_celula_caixa'><textarea class='C_insert_textarea' name='Descricao' id='Descricao'><?php print $Aux_Descricao; ?></textarea></td>
  <tr class='C_insert_linha'>
    <td class='C_insert_celula_escrito'><span class='C_insert_escrito'>LinkImagem</span></td>
    <td class='C_insert_celula_caixa'><input class='C_insert_text' onKeyPress="return(Valida('0',this,event));" name='LinkImagem' type='text' id='LinkImagem' value="<?php print $Aux_P_LinkImagem; ?>">
    <input class='clcaixa' name="P_Nov_LinkImagem" type="file" id="P_Nov_LinkImagem"><br>
    <?php print exibeobjeto(str_replace("Imagens/", "Imagens/mini480-320/", $Aux_LinkImagem), '480', '320'); ?> <a href="<?php print $Aux_LinkImagem; ?>" target="_Imagem">Link Original </a>
    </td></tr>
  <tr class='C_insert_linha'><td colspan='2' class='C_insert_celula_envio'>
      <input type='submit' name='Submit1' value='Enviar' class='C_insert_botao' onclick='return Confere();'>
      <input type='hidden' name='proxima_pagina' value="<?php print $Aux_proxima_pagina;?>">
      <input type='hidden' name='idImagens_Ant' value="<?php print "$Aux_idImagens_Ant"; ?>">
  </td></tr>
</table>
</fieldset>
</form>

<input type='submit' name='Submit2' value='Voltar' class='clbotao' onclick="window.location.href='<?php print $_SESSION["proxima_pagina"]; ?>';">


