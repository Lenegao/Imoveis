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
//Chama as requisições
require_once("conexao.php");
require_once("funcoes.php");
require_once("inicia_sessao.php");
require_once("inicializa_pagina.php");

?>
<div id="TabbedPanels1" class="TabbedPanels">
	<ul class="TabbedPanelsTabGroup">
		<li class="TabbedPanelsTab" tabindex="0">Cadastrar Imovel</li>
		<li class="TabbedPanelsTab" tabindex="0">Visualizar Dados - Imovel</li>
	</ul>
	<div class="TabbedPanelsContentGroup">
		<div class="TabbedPanelsContent"><?php include("Imovel_V_Insert.php"); ?></div>
		<div class="TabbedPanelsContent">
  <?php
print "<br>";
//Conta o Número de imóveis no BD para gerar as páginas
$resultado = mysql_query("select count(*) from Imovel",$P_Conexao);
$Linha_Aux = mysql_fetch_row($resultado);

// Verifica a Ordem da Lista e define na consulta
if ($_SESSION["Imovel"]["order"] == "") $_SESSION["Imovel"]["order"] = "idImovel;desc";
if (isset($_GET["order_Imovel"])) $_SESSION["Imovel"]["order"] = $_GET["order_Imovel"];

// Salva a página atual para um eventual retorno
$_SESSION["proxima_pagina"] = $_SERVER["REQUEST_URI"];

// Comfigura as páginas
$Aux_NumPagTot = $Linha_Aux[0];
$Aux_PosInicial = $_GET["PosInicial"];
if (!isset($_GET["PosInicial"])) $Aux_PosInicial = 0;
$Aux_NumPorPag = 50;
$Aux_Link = "sistema.php?pagina=Imovel_Visualizar.php&PosInicial=#posicao#";
$Aux_proxima_pagina = "sistema.php?pagina=Imovel_Visualizar.php";


?>

<div id='apCorpoRet'> <!-- Trocar por 'apCorpo' o DIV caso queira a Classe; -->
<table class='C_visualizar_tabela'>
  <tr class='C_visualizar_linha_titulo'>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>idImovel <?php print ExibeOrderBy("Imovel","idImovel", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>Titulo <?php print ExibeOrderBy("Imovel","Titulo", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>Descricao <?php print ExibeOrderBy("Imovel","Descricao", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>Observacoes <?php print ExibeOrderBy("Imovel","Observacoes", $Aux_proxima_pagina); ?></span></td>
    <td class='C_visualizar_celula_titulo'><span class='C_visualizar_escrito_titulo'>A&ccedil;&atilde;o</span></td>
  </tr>
<?php
// Construo o Inicio da Consulta, com Campos e a Origem da Tabela
$P_sql = "select idImovel, Titulo, Descricao, Observacoes
                          from Imovel";
// Construo o Final da Consulta, com Order BY e Limit
$P_sql_Final = "
                          order by ".str_replace(";"," ",$_SESSION["Imovel"]["order"])."
                          limit $Aux_PosInicial, $Aux_NumPorPag";

// Coloco o final ORDER BY e LIMIT
$P_sql = $P_sql.$P_sql_Final;

$resultado = mysql_query($P_sql,$P_Conexao);
if ($resultado != false) {
	$Linha_Aux = mysql_fetch_row($resultado);
	while ($Linha_Aux != false) {
		$Aux_idImovel = $Linha_Aux[0];
		$Aux_Titulo = $Linha_Aux[1];
		$Aux_Descricao = $Linha_Aux[2];
		$Aux_Observacoes = $Linha_Aux[3];

?>  
  <tr class='C_visualizar_linha'>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_idImovel; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><?php print $Aux_Titulo; ?></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><textarea class='C_visualizar_textarea'><?php print $Aux_Descricao; ?></textarea></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'><textarea class='C_visualizar_textarea'><?php print $Aux_Observacoes; ?></textarea></span></td>
    <td class='C_visualizar_celula'><span class='C_visualizar_escrito'>
    <a href='<?php print "sistema.php?pagina=Imovel_V_Update.php&idImovel=$Aux_idImovel&proxima_pagina=$Aux_proxima_pagina"; ?>'>Alterar</a>
    - 
    <a onClick='return validar();' href='<?php print "sistema.php?pagina=Imovel_Delete.php&idImovel=$Aux_idImovel&proxima_pagina=$Aux_proxima_pagina"; ?>'>Excluir</a>
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
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1", {defaultTab:1});
TabbedPanels1.defaultTab = 1;
</script>