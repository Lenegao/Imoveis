<link href="estilos.css" rel="stylesheet" type="text/css">

<script src="SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script>
function validar()
  {
  if (confirm ("Voce que mesmo DELETAR este Registro ?"))
    { return true }
  else
    { return false }
  }
</script>

<br>

<?php
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

?>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Cadastrar Endereco</li>
    <li class="TabbedPanelsTab" tabindex="0">Visualizar Dados - Endereco</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><?php include("Endereco_V_Insert.php"); ?></div>
    <div class="TabbedPanelsContent">
  <?php
print "<br>";
$resultado = mysql_query("select count(*) from Endereco",$P_Conexao);
$Linha_Aux = mysql_fetch_row($resultado);

if ($_SESSION["Endereco"]["order"] == "") $_SESSION["Endereco"]["order"] = "idEndereco;desc";
if (isset($_GET["order_Endereco"])) $_SESSION["Endereco"]["order"] = $_GET["order_Endereco"];

$_SESSION["proxima_pagina"] = $_SERVER["REQUEST_URI"];
$Aux_NumPagTot = $Linha_Aux[0];
$Aux_PosInicial = $_GET["PosInicial"];
if (!isset($_GET["PosInicial"])) $Aux_PosInicial = 0;
$Aux_NumPorPag = 50;
$Aux_Link = "sistema.php?pagina=Endereco_Visualizar.php&PosInicial=#posicao#";
$Aux_proxima_pagina = "sistema.php?pagina=Endereco_Visualizar.php";


?>

<div id='apCorpoRet'> <!-- Trocar por 'apCorpo' o DIV caso queira a Classe; -->
<table class='C_visualizar_tabela'>
  <tr class='C_visualizar_linha_titulo'>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>idEndereco <?php print ExibeOrderBy("Endereco","idEndereco", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>idImovel <?php print ExibeOrderBy("Endereco","idImovel", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>CEP <?php print ExibeOrderBy("Endereco","CEP", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>Numero <?php print ExibeOrderBy("Endereco","Numero", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>Complemento <?php print ExibeOrderBy("Endereco","Complemento", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>A&ccedil;&atilde;o</span></td>
  </tr>
<?php
// Construo o Inicio da Consulta, com Campos e a Origem da Tabela
$P_sql = "select idEndereco, idImovel, CEP, Numero, Complemento
                          from Endereco";
// Construo o Final da Consulta, com Order BY e Limit
$P_sql_Final = "
                          order by ".str_replace(";"," ",$_SESSION["Endereco"]["order"])."
                          limit $Aux_PosInicial, $Aux_NumPorPag";

// Consulta Auxiliares de Chaves estrageiras e Altera na consulta original
$P_Cons_idImovel = " (SELECT CONCAT(C1.idImovel,'-',C1.Titulo) FROM Imovel C1 WHERE Endereco.idImovel = C1.idImovel) \n";
if ($P_Cons_idImovel != "") $P_sql = str_replace(" idImovel", $P_Cons_idImovel, $P_sql);

// Coloco o final ORDER BY e LIMIT
$P_sql = $P_sql.$P_sql_Final;

$resultado = mysql_query($P_sql,$P_Conexao);

if ($resultado != false)
  {
  $Linha_Aux = mysql_fetch_row($resultado);
  //$Linha_Aux = mysql_fetch_assoc($resultado);
  while ($Linha_Aux != false)
    {
    //$Aux_idEndereco = $Linha_Aux["idEndereco"];
    //$Aux_idImovel = $Linha_Aux["idImovel"];
    //$Aux_CEP = $Linha_Aux["CEP"];
    //$Aux_Numero = $Linha_Aux["Numero"];
    //$Aux_Complemento = $Linha_Aux["Complemento"];

    $Aux_idEndereco = $Linha_Aux[0];
    $Aux_idImovel = $Linha_Aux[1];
    $Aux_CEP = $Linha_Aux[2];
    $Aux_Numero = $Linha_Aux[3];
    $Aux_Complemento = $Linha_Aux[4];

// Gera lista de Limite quando houver subconsultas
    $Aux_idImovel_T = $Aux_idImovel;
    if (strlen($Aux_idImovel) > 40) $Aux_idImovel = substr($Aux_idImovel, 0, 40)."...";

// Gera lista de Enum do sistema
    
    
?>  
  <tr class='C_visualizar_linha'>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_idEndereco; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito' title='<?php print $Aux_idImovel_T; ?>'><?php print $Aux_idImovel; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_CEP; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_Numero; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_Complemento; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'>
    <a href='<?php print "sistema.php?pagina=Endereco_V_Update.php&idEndereco=$Aux_idEndereco&proxima_pagina=$Aux_proxima_pagina"; ?>'>Alterar</a>
    - 
    <a onClick='return validar();' href='<?php print "sistema.php?pagina=Endereco_Delete.php&idEndereco=$Aux_idEndereco&proxima_pagina=$Aux_proxima_pagina"; ?>'>Excluir</a>
    </span></td>
  </tr>
<?php
    
    $Linha_Aux = mysql_fetch_row($resultado);
    //$Linha_Aux = mysql_fetch_assoc($resultado);
    }
  }
?>
</table>

</div>
<table class='C_paginar_tabela'>
  <tr class='C_paginar_linha'>
    <td class='C_paginar_celula'><span class='C_paginar_escrito'>Pagina</span></td>
    <td class='C_paginar_celula'><span class='C_paginar_escrito'><?php paginar($Aux_Link, $Aux_NumPagTot, $Aux_PosInicial, $Aux_NumPorPag); ?></span></td>
  </tr>
</table>

</div></div><br></div>




<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1", {defaultTab:1});
TabbedPanels1.defaultTab = 1;
//-->
</script>

