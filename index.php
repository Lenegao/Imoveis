<?php

// Pega a referencia vinda pelo GET
$Aux_idImovel_Ant = addslashes($_GET["idImovel"]);
// Gera a Conexão
require_once("painel/conexao.php");
// Faz a Consulta e pega os dados do Imovel
$P_sql = "select idImovel, Titulo, Descricao, Observacoes from Imovel
 where idImovel = \"$Aux_idImovel_Ant\"";

$resultado = mysql_query($P_sql,$P_Conexao);
$P_Linha_Aux = mysql_fetch_row($resultado);

// Pega os dados e coloca em variaveis para facilitar o uso
$Aux_idImovel = htmlentities($P_Linha_Aux[0]);
$Aux_Titulo = htmlentities($P_Linha_Aux[1]);
$Aux_Descricao = htmlentities($P_Linha_Aux[2]);
$Aux_Observacoes = htmlentities($P_Linha_Aux[3]);

// Guarda os dados em um array
$Imovel = array(
	"idImovel"=>$Aux_idImovel,
	"Titulo"=>$Aux_Titulo,
	"Descricao"=>$Aux_Descricao,
	"Observacoes"=>$Aux_Observacoes
			   );

// Pega os dados e coloca em Endereco mo array
// Usando a mesma estratégia do imovel
$P_sql = "select idEndereco, idImovel, CEP, Numero, Complemento from Endereco WHERE idImovel = $Aux_idImovel";
$resultado = mysql_query($P_sql,$P_Conexao);
if ($resultado != false)
  {
  $Linha_Aux = mysql_fetch_row($resultado);
  while ($Linha_Aux != false)
    {
    $Aux_idEndereco = $Linha_Aux[0];
    $Aux_idImovel = $Linha_Aux[1];
    $Aux_CEP = $Linha_Aux[2];
    $Aux_Numero = $Linha_Aux[3];
    $Aux_Complemento = $Linha_Aux[4];
    
	$Imovel["Endereco"][] = array(
		"idEndereco"=>$Aux_idEndereco,
		"idImovel"=>$Aux_idImovel,
		"CEP"=>$Aux_CEP,
		"Numero"=>$Aux_Numero,
		"Complemento"=>$Aux_Complemento
				   );
    $Linha_Aux = mysql_fetch_row($resultado);
    }
  }


// Pega os dados e coloca em Imagens mo array
// Usando a mesma estratégia do imovel
$P_sql = "select idImagens, idImovel, Titulo, Descricao, LinkImagem from Imagens WHERE idImovel = $Aux_idImovel";
$resultado = mysql_query($P_sql,$P_Conexao);
if ($resultado != false)
  {
  $Linha_Aux = mysql_fetch_row($resultado);
  while ($Linha_Aux != false)
    {
    $Aux_idImagens = $Linha_Aux[0];
    $Aux_idImovel = $Linha_Aux[1];
    $Aux_Titulo = $Linha_Aux[2];
    $Aux_Descricao = $Linha_Aux[3];
    $Aux_LinkImagem = $Linha_Aux[4];
    
	$Imovel["Imagens"][] = array(
		"idImagens"=>$Aux_idImagens,
		"idImovel"=>$Aux_idImovel,
		"Titulo"=>$Aux_Titulo,
		"Descricao"=>$Aux_Descricao,
		"LinkImagem"=>$Aux_LinkImagem
				   );
    $Linha_Aux = mysql_fetch_row($resultado);
    }
  }

// Pega os dados e coloca em Caracteriscas mo array
// Aqui fez uma junção de 2 tabelas
// Poderia ter criado um View também
$P_sql = "SELECT idCaracteristicas, idImovel, ValorI, ValorD, ValorT, Nome, Conteudo, Tipo FROM Caracteristicas_Imovel LEFT JOIN Caracteristicas USING (idCaracteristicas) WHERE idImovel = $Aux_idImovel";
$resultado = mysql_query($P_sql,$P_Conexao);

if ($resultado != false)
  {
  $Linha_Aux = mysql_fetch_row($resultado);
  while ($Linha_Aux != false)
    {
    $Aux_idCaracteristicas = $Linha_Aux[0];
    $Aux_idImovel = $Linha_Aux[1];
    $Aux_Valor['Inteiro'] = $Linha_Aux[2];
    $Aux_Valor['Decimal'] = $Linha_Aux[3];
    $Aux_Valor['Texto'] = $Linha_Aux[4];
    $Aux_Nome = $Linha_Aux[5];
    $Aux_Conteudo = $Linha_Aux[6];
    $Aux_Tipo = $Linha_Aux[7];

	$Imovel["Caracteristicas"][] = array(
		"idCaracteristicas"=>$Aux_idCaracteristicas,
		"idImovel"=>$Aux_idImovel,
		"ValorDefinido"=>$Aux_Valor[$Aux_Tipo],
		"Valor"=>$Aux_Valor,
		"Nome"=>$Aux_Nome,
		"Conteudo"=>$Aux_Conteudo,
		"Tipo"=>$Aux_Tipo
				   );
    
    $Linha_Aux = mysql_fetch_row($resultado);
    }
  }



// Se estiver enviado JSON, gera o JSON, caso contrário
// faz um print_r do array, já montato

$Imovel_JSON = json_encode($Imovel);
if (isset($_GET["JSON"]))
	print $Imovel_JSON;
else
	print_r($Imovel);

?>
