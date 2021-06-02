<link href="estilos.css" rel="stylesheet" type="text/css">

<script src="SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script>
function validar() {
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
    <li class="TabbedPanelsTab" tabindex="0">Cadastrar Caracteristicas</li>
    <li class="TabbedPanelsTab" tabindex="0">Visualizar Dados - Caracteristicas</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><?php include("Caracteristicas_V_Insert.php"); ?></div>
    <div class="TabbedPanelsContent">
  <?php
print "<br>";
$resultado = mysql_query("select count(*) from Caracteristicas",$P_Conexao);
$Linha_Aux = mysql_fetch_row($resultado);

if ($_SESSION["Caracteristicas"]["order"] == "") $_SESSION["Caracteristicas"]["order"] = "idCaracteristicas;desc";
if (isset($_GET["order_Caracteristicas"])) $_SESSION["Caracteristicas"]["order"] = $_GET["order_Caracteristicas"];

$_SESSION["proxima_pagina"] = $_SERVER["REQUEST_URI"];
$Aux_NumPagTot = $Linha_Aux[0];
$Aux_PosInicial = $_GET["PosInicial"];
if (!isset($_GET["PosInicial"])) $Aux_PosInicial = 0;
$Aux_NumPorPag = 50;
$Aux_Link = "sistema.php?pagina=Caracteristicas_Visualizar.php&PosInicial=#posicao#";
$Aux_proxima_pagina = "sistema.php?pagina=Caracteristicas_Visualizar.php";

function P_Enum_Tipo($P_CampoEnum)
  {
  switch ($P_CampoEnum)
    {
    case "Inteiro": return "Inteiro"; break;
    case "Decimal": return "Decimal"; break;
    case "Texto": return "Texto"; break;
    default: return "ERRO";
    }
  }



?>

<div id='apCorpoRet'> <!-- Trocar por 'apCorpo' o DIV caso queira a Classe; -->
<table class='C_visualizar_tabela'>
  <tr class='C_visualizar_linha_titulo'>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>idCaracteristicas <?php print ExibeOrderBy("Caracteristicas","idCaracteristicas", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>Nome <?php print ExibeOrderBy("Caracteristicas","Nome", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>Conteudo <?php print ExibeOrderBy("Caracteristicas","Conteudo", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>Tipo <?php print ExibeOrderBy("Caracteristicas","Tipo", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>A&ccedil;&atilde;o</span></td>
  </tr>
<?php
// Construo o Inicio da Consulta, com Campos e a Origem da Tabela
$P_sql = "select idCaracteristicas, Nome, Conteudo, Tipo
                          from Caracteristicas";
// Construo o Final da Consulta, com Order BY e Limit
$P_sql_Final = "
                          order by ".str_replace(";"," ",$_SESSION["Caracteristicas"]["order"])."
                          limit $Aux_PosInicial, $Aux_NumPorPag";

// Coloco o final ORDER BY e LIMIT
$P_sql = $P_sql.$P_sql_Final;

$resultado = mysql_query($P_sql,$P_Conexao);

if ($resultado != false)
  {
  $Linha_Aux = mysql_fetch_row($resultado);
  while ($Linha_Aux != false)
    {
    $Aux_idCaracteristicas = $Linha_Aux[0];
    $Aux_Nome = $Linha_Aux[1];
    $Aux_Conteudo = $Linha_Aux[2];
    $Aux_Tipo = $Linha_Aux[3];

// Gera lista de Enum do sistema
    $Aux_Tipo = P_Enum_Tipo($Aux_Tipo);
    
    
?>  
  <tr class='C_visualizar_linha'>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_idCaracteristicas; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_Nome; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_Conteudo; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_Tipo; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'>
    <a href='<?php print "sistema.php?pagina=Caracteristicas_V_Update.php&idCaracteristicas=$Aux_idCaracteristicas&proxima_pagina=$Aux_proxima_pagina"; ?>'>Alterar</a>
    - 
    <a onClick='return validar();' href='<?php print "sistema.php?pagina=Caracteristicas_Delete.php&idCaracteristicas=$Aux_idCaracteristicas&proxima_pagina=$Aux_proxima_pagina"; ?>'>Excluir</a>
    </span></td>
  </tr>
<?php
    
    $Linha_Aux = mysql_fetch_row($resultado);
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

