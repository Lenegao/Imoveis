<?php require_once("inicia_sessao.php"); ?>
<html>
<head>
<title>API Imóveis</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	color: #FFFFFF;
}
-->
</style>
<script>
function Confirmar()
  {
  if (confirm ("Voce que mesmo DELETAR a senha do ADMINISTRADOR ?"))
    { return true }
  else
    { return false }
  }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<link href="estilos.css" rel="stylesheet" type="text/css">
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td height="70" colspan="2" bordercolor="#000000" bgcolor="#FFFFFF"><table height="60" width=98% cellspacing=0 cellpadding=0 class="C_sistema_topo" border=0 align="center">
      <tr>
        <td width=11 valign="top" align=left><img src="sup-izq.gif" width=11 height=11></td>
        <td rowspan=2>
<br>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><span class="C_sistema_escrito">CRUD API Imoveis</span></td>
                  <td><div align="right"></div></td>
              </tr>
            </table>
            <br></td>
        <td width=11 valign="top" align=right><img src="sup-der.gif" width=11 height=11></td>
      </tr>
      <tr>
        <td width=11 align=left valign=bottom><img src="inf-izq.gif" width=11 height=11></td>
        <td width=11 align=right valign=bottom><img src="inf-der.gif" width=11 height=11></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width="175" align="center" valign="top" bordercolor="#000000" bgcolor="#F8F8F8"><br>
      <table width=90% cellspacing=0 cellpadding=0 class="C_sistema_menu" border=0 align="center"> 
<tr> 
<td width=11 valign="top" align=left><img src="sup-izq.gif" width=11 height=11></td> 
<td rowspan=2> 
<font color="#ffffff" face="verdana,arial,helvetica" size=1> 
<br> 
</font>
<table width="100%%" border="0" cellspacing="0" cellpadding="0">

        <tr><td ><a href="sistema.php?pagina=Imovel_Visualizar.php" class="C_sistema_link">Imovel</a></td></tr>
        <tr><td ><a href="sistema.php?pagina=Endereco_Visualizar.php" class="C_sistema_link">Endereco</a></td></tr>
        <tr><td ><a href="sistema.php?pagina=Imagens_Visualizar.php" class="C_sistema_link">Imagens</a></td></tr>
        <tr><td ><a href="sistema.php?pagina=Caracteristicas_Visualizar.php" class="C_sistema_link">Caracteristicas</a></td></tr>
        <tr><td ><a href="sistema.php?pagina=Caracteristicas_Imovel_Visualizar.php" class="C_sistema_link">Caracteristicas_Imovel</a></td></tr>

  <tr><td>&nbsp;</td></tr>
  <tr><td><a href="deletarsenha.php" class="C_sistema_linksair" onclick="return Confirmar();">! Deletar Senha !</a><br></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><a href="logout.php" class="C_sistema_linksair">+ Sair +</a><br></td></tr>
</table><br>

</td> 
<td width=11 valign="top" align=right><img src="sup-der.gif" width=11 height=11></td> 
</tr> 
<tr> 
<td width=11 align=left valign=bottom><img src="inf-izq.gif" width=11 height=11></td> 
<td width=11 align=right valign=bottom><img src="inf-der.gif" width=11 height=11></td> 
</tr> 
</table>     <br>
    <br></td>
    <td valign="top" bgcolor="#F8F8F8"><span class="style3">      </span>      <br>
      <table width=90% cellspacing=0 cellpadding=0 class="C_sistema_menu" border=0 align="center">
      <tr>
        <td width=11 valign="top" align=left><img src="sup-izq.gif" width=11 height=11></td>
        <td rowspan=2 class="C_sistema_conteudo"><br>
          <?php if (isset($_GET["pagina"])) include($_GET["pagina"]); else include("boasvindas.php"); ?>
          <br>
          <br>        </td>
        <td width=11 valign="top" align=right><img src="sup-der.gif" width=11 height=11></td>
      </tr>
      <tr>
        <td width=11 align=left valign=bottom><img src="inf-izq.gif" width=11 height=11></td>
        <td width=11 align=right valign=bottom><img src="inf-der.gif" width=11 height=11></td>
      </tr>
    </table>    
    </td>
  </tr>
</table>
</body>
</html>
