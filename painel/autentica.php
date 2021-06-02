<?php
session_start();
include("conexao.php");

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

$resultado=mysql_query("select idusuarios, usuario
                          from usuarios
						  where upper(login)=upper(\"$usuario\") and senha = \"$senha\"");
if($resultado!=false)
  {
  $linha=mysql_fetch_row($resultado);
  if($linha!= false)
    {
     $_SESSION["S_idusuario"]=$linha[0];
     $_SESSION["S_usuario"]=$linha[1];
     $_SESSION["S_autenticado"]=true;
     print "<script language=\"JavaScript\">window.location.href=\"sistema.php\";</script>";
	 exit();
    }
  }
else
	{
	if (file_exists("ArquivoSenha.php"))
		{
		include("ArquivoSenha.php");
		if (strtoupper($usuario) == strtoupper($UsuarioArquivo) && md5("P#Sen10#".$senha) == $SenhaArquivo)
			{
			$_SESSION["S_usuario"]=$UsuarioArquivo;
			$_SESSION["S_autenticado"]=true;
			print "<script language=\"JavaScript\">window.location.href=\"sistema.php\";</script>";
			exit();
			}
		}
	else
		{
		$ArquivoSenha = "
		<?php 
		\$UsuarioArquivo = \"$usuario\";
		\$SenhaArquivo = \"".md5("P#Sen10#".$senha)."\";
		?>
		";
		$_SESSION["S_usuario"]=$usuario;
		$_SESSION["S_autenticado"]=true;
		file_put_contents("ArquivoSenha.php",$ArquivoSenha);
		
		print "<script language=\"JavaScript\">window.location.href=\"sistema.php\";</script>";
		exit();
		}
	}
?>
<br>LOGIN INVÁLIDO<br>
<br>Usuário ou Senha INCORRETOS!!!!!<br>
<script language="JavaScript">  window.setTimeout("window.location.href='index.php'",3000); </script>
