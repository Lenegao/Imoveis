<?php

/*
Função para redimensionar uma imagem.
Caso a largura ou a altura sejam preenchidos com 0, ele é 
definido proporcionalmente com o tamanho original
*/

function imagecreatefrombmp($p_sFile)
    { 
        //    Load the image into a string 
        $file    =    fopen($p_sFile,"rb"); 
        $read    =    fread($file,10); 
        while(!feof($file)&&($read<>"")) 
            $read    .=    fread($file,1024); 
        
        $temp    =    unpack("H*",$read); 
        $hex    =    $temp[1]; 
        $header    =    substr($hex,0,108); 
        
        //    Process the header 
        //    Structure: http://www.fastgraph.com/help/bmp_header_format.html 
        if (substr($header,0,4)=="424d") 
        { 
            //    Cut it in parts of 2 bytes 
            $header_parts    =    str_split($header,2); 
            
            //    Get the width        4 bytes 
            $width            =    hexdec($header_parts[19].$header_parts[18]); 
            
            //    Get the height        4 bytes 
            $height            =    hexdec($header_parts[23].$header_parts[22]); 
            
            //    Unset the header params 
            unset($header_parts); 
        } 
        
        //    Define starting X and Y 
        $x                =    0; 
        $y                =    1; 
        
        //    Create newimage 
        $image            =    imagecreatetruecolor($width,$height); 
        
        //    Grab the body from the image 
        $body            =    substr($hex,108); 

        //    Calculate if padding at the end-line is needed 
        //    Divided by two to keep overview. 
        //    1 byte = 2 HEX-chars 
        $body_size        =    (strlen($body)/2); 
        $header_size    =    ($width*$height); 

        //    Use end-line padding? Only when needed 
        $usePadding        =    ($body_size>($header_size*3)+4); 
        
        //    Using a for-loop with index-calculation instaid of str_split to avoid large memory consumption 
        //    Calculate the next DWORD-position in the body 
        for ($i=0;$i<$body_size;$i+=3) 
        { 
            //    Calculate line-ending and padding 
            if ($x>=$width) 
            { 
                //    If padding needed, ignore image-padding 
                //    Shift i to the ending of the current 32-bit-block 
                if ($usePadding) 
                    $i    +=    $width%4; 
                
                //    Reset horizontal position 
                $x    =    0; 
                
                //    Raise the height-position (bottom-up) 
                $y++; 
                
                //    Reached the image-height? Break the for-loop 
                if ($y>$height) 
                    break; 
            } 
            
            //    Calculation of the RGB-pixel (defined as BGR in image-data) 
            //    Define $i_pos as absolute position in the body 
            $i_pos    =    $i*2; 
            $r        =    hexdec($body[$i_pos+4].$body[$i_pos+5]); 
            $g        =    hexdec($body[$i_pos+2].$body[$i_pos+3]); 
            $b        =    hexdec($body[$i_pos].$body[$i_pos+1]); 
            
            //    Calculate and draw the pixel 
            $color    =    imagecolorallocate($image,$r,$g,$b); 
            imagesetpixel($image,$x,$height-$y,$color); 
            
            //    Raise the horizontal position 
            $x++; 
        } 
        
        //    Unset the body / free the memory 
        unset($body); 
        
        //    Return image-object 
        return $image; 
    }

function RedimensionaImagem($ArquivoOriginal, $NovoArquivo, $NovaLargura, $NovaAltura, $CaberNaArea = 0)
	{
	// Testa se o arquivo é imagem
	if (!preg_match("/jpg|jpeg|png|gif|bmp/i",$ArquivoOriginal))	return false;
	// Testa se o GD está ativo
	$gd2 = checkgd() or die("erro no GD"); 
	// Pega as dimensões da imagem
	$Informacoes_Imagem = GetImageSize($ArquivoOriginal);
	list($Largura, $Altura) = $Informacoes_Imagem;
	// Calculando a nova largura e altura, caso as duas seja zeros, retorna um erro
	if ($NovaLargura == 0 && $NovaAltura == 0)
		return false;
	else if ($NovaLargura == 0 || $NovaAltura == 0)
		{
		// Calculando a nova largura
		if ($NovaLargura == 0)
			{
			$NovaLarguraFinal = round($Largura / $Altura * $NovaAltura);
			$NovaAlturaFinal = $NovaAltura;
			}
		// Calculando a nova Algura
		if ($NovaAltura == 0)
			{
			$NovaAlturaFinal = round($Altura / $Largura * $NovaLargura);
			$NovaLarguraFinal = $NovaLargura;
			}
		}
	else if ($CaberNaArea == 0)
		{
			// Altura e largura definidos
			$NovaLarguraFinal = $NovaLargura;
			$NovaAlturaFinal = $NovaAltura;
		}
	else
		{
			// Altura e largura definidos, porem sem perder a proprocionalidade
			$LarguraFator = $Largura / $NovaLargura;
			$AlturaFator = $Altura / $NovaAltura;
			if ($LarguraFator > $AlturaFator)
				$FatorResimensionamento = $LarguraFator;
			else
				$FatorResimensionamento = $AlturaFator;

			$NovaLarguraFinal = round($Largura / $FatorResimensionamento);
			$NovaAlturaFinal = round($Altura / $FatorResimensionamento);			
		}

	//Cria a imagem em um novo tamanho.
	//Cria a imagem de origem na variável
	if (strpos(strtolower($ArquivoOriginal),"jpg") || strpos(strtolower($ArquivoOriginal),"jpeg"))
		$src_img = imagecreatefromjpeg($ArquivoOriginal);
	if (strpos(strtolower($ArquivoOriginal),"png"))
		$src_img = imagecreatefrompng($ArquivoOriginal);
	if (strpos(strtolower($ArquivoOriginal),"gif"))
		$src_img = imagecreatefromgif($ArquivoOriginal);
	if (strpos(strtolower($ArquivoOriginal),"bmp"))
		$src_img = imagecreatefrombmp($ArquivoOriginal);
	//Cria a imagem de destino na variável
	$dst_img = ImageCreateTrueColor($NovaLarguraFinal,$NovaAlturaFinal); 
	//Testa se os valores estão corretos, devem ser maiores que 0
	if ($NovaLarguraFinal <= 0 || $NovaAlturaFinal <= 0)
		return false;
	//Faz a cópia da imagem, re-amostrada
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$NovaLarguraFinal,$NovaAlturaFinal,$Largura,$Altura); 
	//Excluir o destino, se houver
	if (file_exists($NovoArquivo)) unlink($NovoArquivo);
	//Joga o conteúdo da variável para um arquivo
	imagejpeg($dst_img, $NovoArquivo);
	//Limpa as variáveis
	imagedestroy($dst_img);
	imagedestroy($src_img);

	return true;
	}


/* 
Function checkgd() 
Verifica a versão do GD e retorna "yes" quando a versão é superior a 2
*/ 
function checkgd()
	{
	$gd2=""; 
	ob_start(); 
	phpinfo(8);
	$phpinfo=ob_get_contents(); 
	ob_end_clean(); 
	$phpinfo=strip_tags($phpinfo); 
	$phpinfo=stristr($phpinfo,"gd version"); 
	$phpinfo=stristr($phpinfo,"version"); 
	preg_match('/\d/', $phpinfo, $gd); 
	if ($gd[0]=='2')
		{
		$gd2="yes";
		}
	return $gd2; 
}

/* 
Function createthumb($name, $filename, $new_w, $new_h) 
Cria uma imagem redimensionada
Variáveis: 
$name - Nome da imagem original 
$filename - Nome da imagem redimensionado 
$new_w - Nova largura da imagem redimensionada
$new_h - Nova altura da imagem redimensionada
*/

function createthumb($name, $filename, $new_w, $new_h)
	{
	global $gd2;
	$system = explode(".",$name);
	
	if (preg_match("/jpg|jpeg/",$system[1]))
		{
		$src_img = imagecreatefromjpeg($name);
		}
	
	$old_x = imageSX($src_img); 
	$old_y = imageSY($src_img); 
	
	$thumb_w = $new_w; 
	$thumb_h = $new_h;
	
	$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h); 
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	
	$newFile = $filename;
	unlink($newFile);
	imagejpeg($dst_img, $newFile);
	
	imagedestroy($dst_img);
	imagedestroy($src_img);
	
	return true;
	}

 /*---------------------------------------------------------------------------------
Incluir um unico argumento no LINK
---------------------------------------------------------------------------------*/
function IncluirUnico($LinkAtual, $Marcador, $Conteudo, $Final = "&")
	{
	$Pos_InicioMarcador = strpos($LinkAtual, $Marcador);
	if ($Pos_InicioMarcador === false)
		{
		// Não Achou o Marcador			
		}
	else
		{
		$Con_InicioMarcador = substr($LinkAtual, $Pos_InicioMarcador - 0);
		$Pos_FimMarcador = strpos($Con_InicioMarcador, $Final);
		if ($Pos_FimMarcador == 0)
			$Con_Marcador = $Con_InicioMarcador;
		else
			$Con_Marcador = substr($Con_InicioMarcador, 0, $Pos_FimMarcador + 0);
			
		}
	
	
	$LinkSemAjuste = str_replace($Con_Marcador, "", $LinkAtual);
	$LinkAjustado = $LinkSemAjuste.$Final.$Marcador.$Conteudo;

	$LinkAjustado = str_replace('&&', '&', $LinkAjustado);
	print "LA: $LinkAjustado | $LinkSemAjuste | $Con_Marcador | $Pos_FimMarcador<br>\n";
	return $LinkAjustado;
	}
  


/*---------------------------------------------------------------------------------
Gera o FBackUP, que é um Backup das alterações do sitema
---------------------------------------------------------------------------------*/
function FBackup($Tabela, $ConsultaSQL, $Conexao, $TabelaBackup = "Backup", $CamposBackup = "Tabela, ConsultaSQL, BSESSION, BSERVER, BGET, BPOST, DataHora")
        {
        $F_SESSION = addslashes(print_r($_SESSION, true));
        $F_SERVER = addslashes(print_r($_SERVER, true));
        $F_GET = addslashes(print_r($_GET, true));
        $F_POST = addslashes(print_r($_POST, true));
        $F_ConsultaSQL= addslashes($ConsultaSQL);



        $Consulta = "INSERT INTO $TabelaBackup ($CamposBackup) VALUES (\"$Tabela\", \"$F_ConsultaSQL\", \"$F_SESSION\", \"$F_SERVER\", \"$F_GET\", \"$F_POST\", NOW())";
        $resultado = mysql_query($Consulta, $Conexao);

        if ($resultado != true)
                print "ERRO BACKUP!!!";
        }

/*---------------------------------------------------------------------------------
Remove os Acento das frase e ajusta a URL, para se gerar um arquivo no disco 
function remove_assentos($frase) e function AjeitaURL($P_NomeArquivo)
---------------------------------------------------------------------------------*/
function remove_assentos($frase)
{
$caracteres=array(
array("á","a"),array("à","a"),array("Á","A"),array("À","A"),array("â","a"),array("ã","a"),array("Â","A"),array("Ã","A"),array("å","a"),array("ä","a"),array("Ä","A"),array("Å","A"),
array("é","e"),array("è","e"),array("ê","e"),array("É","E"),array("È","E"),array("Ê","E"),array("ë","e"),
array("í","i"),array("ì","i"),array("î","i"),array("Í","I"),array("Ì","I"),array("Î","I"),array("ï","i"),
array("ó","o"),array("ò","o"),array("ô","o"),array("õ","o"),array("Ó","O"),array("Ò","O"),array("Ô","O"),array("Õ","O"),array("ö","o"),array("Ö","O"),
array("ú","u"),array("ù","u"),array("û","u"),array("Ú","U"),array("Ù","U"),array("Û","U"),array("ü","u"),array("Ü","U"),array("ü","u"),array("Ü","U"),
array("ç","c"),array("Ç","C"),
array("ñ","n"),array("Ñ","N"),
array(" ","-")
);
$saida="";

for($i=0;$i<strlen($frase);$i++)
  {
   $posicao=-1;
   $caracter=substr($frase,$i,1);
   if(ord($caracter)>127)
   for($j=0;$j<count($caracteres);$j++)
     {
	  if($caracteres[$j][0]==$caracter)
	    {
		 $posicao=$j;
		 break;
		}
	 }
	if($posicao>=0)
	  {
	   $saida=$saida.$caracteres[$posicao][1];
	  }
	 else
	  {
	   $saida=$saida.$caracter;
	  } 
  }
return($saida);
}

function AjeitaURL($P_NomeArquivo)
	{
	$P_NA = remove_assentos($P_NomeArquivo);
	$P_NA = urlencode($P_NA);
	$P_NA = str_replace("%2F","_",$P_NA);
	$P_NA = str_replace("+","_",$P_NA);
	$P_NA = str_replace("%","",$P_NA);
	return $P_NA;
	}


function AtualizarArquivo($NomeArquivoAntigo, $NomeArquivoNovo, $PostNovo, $NomeTabela)
  {
    $NomeAuxiliar = $NomeArquivoNovo;
	if (!file_exists($NomeTabela)) mkdir($NomeTabela);
	if (!file_exists($NomeTabela."/mini128-128")) mkdir($NomeTabela."/mini128-128");
	if (!file_exists($NomeTabela."/mini480-320")) mkdir($NomeTabela."/mini480-320");
	if (!file_exists($NomeTabela."/mini800-480")) mkdir($NomeTabela."/mini800-480");
	if (!file_exists($NomeTabela."/mini1024-768")) mkdir($NomeTabela."/mini1024-768");
	if (!file_exists($NomeTabela."/mini1280-720")) mkdir($NomeTabela."/mini1280-720");
	if (!file_exists($NomeTabela."/mini1920-1080")) mkdir($NomeTabela."/mini1920-1080");
	if (is_uploaded_file($_FILES[$PostNovo]['tmp_name']) && $_FILES['userfile']['size'] < 12000000)
	  {
	  if (file_exists($NomeArquivoAntigo))
	  	{
		unlink($NomeArquivoAntigo);
		unlink(str_replace($NomeTabela,$NomeTabela."/mini128-128",$NomeArquivoAntigo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini480-320",$NomeArquivoAntigo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini800-480",$NomeArquivoAntigo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini1024-768",$NomeArquivoAntigo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini1280-720",$NomeArquivoAntigo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini1920-1080",$NomeArquivoAntigo));
		}
	  $P_Arquivo =  $NomeTabela."/".AjeitaURL($_FILES[$PostNovo]['name']);
	  if (file_exists($P_Arquivo))
		{
		$P_Contador_do_Arquivo = 1;
		$P_Extensao_do_Arquivo = substr($P_Arquivo,-4,4);
		$P_Nome_do_Arquivo = substr($P_Arquivo,0,strlen($P_Arquivo) - 4);
		while (file_exists($P_Nome_do_Arquivo."($P_Contador_do_Arquivo)".$P_Extensao_do_Arquivo))
		  { $P_Contador_do_Arquivo++; }
		$P_Arquivo = $P_Nome_do_Arquivo."($P_Contador_do_Arquivo)".$P_Extensao_do_Arquivo;
		}
	  if (!file_exists($P_Arquivo))
		{
		$NomeAuxiliar = $P_Arquivo;
		$P_Conteudo = file_get_contents($_FILES[$PostNovo]['tmp_name']);
		$P_handle = fopen($P_Arquivo, 'x');
		fwrite($P_handle, $P_Conteudo);
		fclose($P_handle);
		
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini128-128",$P_Arquivo),128,128,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini480-320",$P_Arquivo),480,320,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini800-480",$P_Arquivo),800,480,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini1024-768",$P_Arquivo),1024,768,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini1280-720",$P_Arquivo),1280,720,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini1920-1080",$P_Arquivo),1920,1080,1);
		}
	  $SemErros = true;
	  }
	else
	  {
		if ($NomeArquivoNovo == "" || $NomeArquivoAntigo == "")
		  {
		  if (file_exists($NomeArquivoAntigo))
		    {
			unlink($NomeArquivoAntigo);
			unlink(str_replace($NomeTabela,$NomeTabela."/mini128-128",$NomeArquivoAntigo));
			unlink(str_replace($NomeTabela,$NomeTabela."/mini480-320",$NomeArquivoAntigo));
			unlink(str_replace($NomeTabela,$NomeTabela."/mini800-480",$NomeArquivoAntigo));
			unlink(str_replace($NomeTabela,$NomeTabela."/mini1024-768",$NomeArquivoAntigo));
			unlink(str_replace($NomeTabela,$NomeTabela."/mini1280-720",$NomeArquivoAntigo));
			unlink(str_replace($NomeTabela,$NomeTabela."/mini1920-1080",$NomeArquivoAntigo));
			}
		  $SemErros = true;
		  }
		else
		  {
		    if (strpos($NomeAuxiliar, $NomeTabela."/") !== 0)
			  $NomeAuxiliar =  $NomeTabela."/".$NomeAuxiliar;
			  
			if (file_exists($NomeArquivoAntigo) && ($NomeArquivoAntigo != $NomeAuxiliar))
			  {
			  if (!file_exists($NomeAuxiliar))
				$SemErros = rename($NomeArquivoAntigo, $NomeAuxiliar);
			  else
				{
				$P_Contador_do_Arquivo = 1;
				$P_Extensao_do_Arquivo = substr("$NomeAuxiliar",-4,4);
				$P_Nome_do_Arquivo = substr("$NomeAuxiliar",0,strlen("$NomeAuxiliar") - 4);
				while (file_exists($P_Nome_do_Arquivo."($P_Contador_do_Arquivo)".$P_Extensao_do_Arquivo))
				  { $P_Contador_do_Arquivo++; }
				$NomeArquivoNovo = $P_Nome_do_Arquivo."($P_Contador_do_Arquivo)".$P_Extensao_do_Arquivo;
				$SemErros = rename($NomeArquivoAntigo, $NomeAuxiliar);
				rename($str_replace($NomeTabela,$NomeTabela."/mini128-128",$NomeArquivoAntigo), str_replace($NomeTabela,$NomeTabela."/mini128-128",$NomeAuxiliar));
				rename($str_replace($NomeTabela,$NomeTabela."/mini480-320",$NomeArquivoAntigo), str_replace($NomeTabela,$NomeTabela."/mini480-320",$NomeAuxiliar));
				rename($str_replace($NomeTabela,$NomeTabela."/mini800-480",$NomeArquivoAntigo), str_replace($NomeTabela,$NomeTabela."/mini800-480",$NomeAuxiliar));
				rename($str_replace($NomeTabela,$NomeTabela."/mini1024-768",$NomeArquivoAntigo), str_replace($NomeTabela,$NomeTabela."/mini1024-768",$NomeAuxiliar));
				rename($str_replace($NomeTabela,$NomeTabela."/mini1280-720",$NomeArquivoAntigo), str_replace($NomeTabela,$NomeTabela."/mini1280-720",$NomeAuxiliar));
				rename($str_replace($NomeTabela,$NomeTabela."/mini1920-1080",$NomeArquivoAntigo), str_replace($NomeTabela,$NomeTabela."/mini1920-1080",$NomeAuxiliar));
				}
			  }
		    }
	  }
  if ($SemErros == true || $NomeArquivoAntigo == "")
    return $NomeAuxiliar;
  else
    return $NomeArquivoAntigo;
  }

function InsereArquivo($NomeArquivo, $PostNovo, $NomeTabela)
  {
	if (!file_exists($NomeTabela)) mkdir($NomeTabela);
	if (!file_exists($NomeTabela."/mini128-128")) mkdir($NomeTabela."/mini128-128");
	if (!file_exists($NomeTabela."/mini480-320")) mkdir($NomeTabela."/mini480-320");
	if (!file_exists($NomeTabela."/mini800-480")) mkdir($NomeTabela."/mini800-480");
	if (!file_exists($NomeTabela."/mini1024-768")) mkdir($NomeTabela."/mini1024-768");
	if (!file_exists($NomeTabela."/mini1280-720")) mkdir($NomeTabela."/mini1280-720");
	if (!file_exists($NomeTabela."/mini1920-1080")) mkdir($NomeTabela."/mini1920-1080");
	if (is_uploaded_file($_FILES[$PostNovo]['tmp_name']) && $_FILES['userfile']['size'] < 12000000)
	  {
	  if (file_exists($NomeArquivo))
	  	{
		unlink($NomeArquivo);
		unlink(str_replace($NomeTabela,$NomeTabela."/mini128-128",$NomeArquivo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini480-320",$NomeArquivo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini800-480",$NomeArquivo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini1024-768",$NomeArquivo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini1280-720",$NomeArquivo));
		unlink(str_replace($NomeTabela,$NomeTabela."/mini1920-1080",$NomeArquivo));
		}
	  $P_Arquivo = $NomeTabela."/".AjeitaURL($_FILES[$PostNovo]['name']);
	  if (file_exists($P_Arquivo))
		{
		$P_Contador_do_Arquivo = 1;
		$P_Extensao_do_Arquivo = substr($P_Arquivo,-4,4);
		$P_Nome_do_Arquivo = substr($P_Arquivo,0,strlen($P_Arquivo) - 4);
		while (file_exists($P_Nome_do_Arquivo."($P_Contador_do_Arquivo)".$P_Extensao_do_Arquivo))
		  { $P_Contador_do_Arquivo++; }
		$P_Arquivo = $P_Nome_do_Arquivo."($P_Contador_do_Arquivo)".$P_Extensao_do_Arquivo;
		}
	  if (!file_exists($P_Arquivo))
		{
		$NomeArquivo = $P_Arquivo;
		$P_Conteudo = file_get_contents($_FILES[$PostNovo]['tmp_name']);
		$P_handle = fopen($P_Arquivo, 'x');
		fwrite($P_handle, $P_Conteudo);
		fclose($P_handle);

		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini128-128",$P_Arquivo),128,128,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini480-320",$P_Arquivo),480,320,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini800-480",$P_Arquivo),800,480,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini1024-768",$P_Arquivo),1024,768,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini1280-720",$P_Arquivo),1280,1024,1);
		RedimensionaImagem($P_Arquivo, str_replace($NomeTabela,$NomeTabela."/mini1920-1080",$P_Arquivo),1920,1080,1);

		}
	  }
  return $NomeArquivo;
  }


function unhtmlentities ($string)
{
    $trans_tbl = get_html_translation_table (HTML_ENTITIES);
    $trans_tbl = array_flip ($trans_tbl);
    return strtr ($string, $trans_tbl);
}

function paginar($link, $total, $posicao, $qt = 5, $limite = 10, $hashtag = "")
{
  if ($total > $limite * $qt)
	{
	$V_link = explode("#posicao#", $link, 2);
	?>
<input name="idvalorpesquisa" type="text" id="idvalorpesquisa" size="4" maxlength="18" />
<input type="button" name="button" id="button" value="ir" onclick="window.location='<?php print $V_link[0]; ?>'+((parseInt(document.getElementById('idvalorpesquisa').value)-1)*<?php print $qt; ?>)+'<?php print $V_link[1]; ?>'" />
<?php
	}
  $telas = floor($total/$qt)+1;
  if (($total/$qt) == floor($total/$qt)) $telas--;
  $link0 = str_replace("#posicao#","0"				,$link);
  $link1 = str_replace("#posicao#",($posicao-$qt)	,$link);
  $link2 = str_replace("#posicao#",($posicao+$qt)	,$link);
  $link3 = str_replace("#posicao#",(($telas-1)*$qt)	,$link);


	// Pega a pagina atual
	$telaatual = floor($posicao / $qt);
	
	// Se tiver menas páginas do que o limite, pagina todas
	if ($telas <= $limite)
		{
		$telainicial = 0;
		$telafinal = $telas;
		}
	else
		{
		// Define a página incial
		if ($telaatual < floor($limite / 2))
			{
			$telainicial = 0;
			$telafinal = $limite;
			}
		else if ($telaatual > $telas - ceil($limite / 2))
			{
			$telainicial = $telas - $limite;
			$telafinal = $telas;
			}
		else
			{
			$telainicial = $telaatual - floor($limite / 2) + 1;
			$telafinal = $telaatual + ceil($limite / 2) + 1;
			}
		}


  
  if ($posicao-$qt >= 0) print " <a href=\"$link0$hashtag\">&lt;&lt;</a> "; else print " &lt;&lt; ";
//print "INI:$telainicial FIM: $telafinal";
  for ($i = $telainicial; $i < $telafinal; $i++)
    {
    if ($posicao != $i*$qt)
	  {
      $linkAux = str_replace("#posicao#",($i*$qt)	,$link);
	  print " <a href=\"$linkAux$hashtag\">|".($i+1)."|</a>";
	  }
	else
	  print " |".($i+1)."| ";
	}
  if ($posicao+$qt < $total) print " <a href=\"$link3$hashtag\">&gt;&gt;</a> "; else print " &gt;&gt; ";
}


function duascasas($valor)
{
	$aux = round($valor,2);
	if ($aux == round($aux,0)) $aux = $aux.".00";
	else if ($aux == round($aux,1)) $aux = $aux."0";
	return $aux;
}

function moedareal($valor)
{
  $aux = duascasas($valor);
  $aux = str_replace(".",",",$aux);
  return $aux;
}

//Incrementa só uma vez na sessão incrementado
function unica_incid($semid, $idarq, $incrementado)
{
  if ($_SESSION[$incrementado] == "")
    {
	$_SESSION[$incrementado] = true;
	return incid($semid, $idarq);
	}
  else
    {
    if(file_exists($idarq))
      {
	  include($idarq);
	  return $idcont;
      }
	return 0;
	}
}

//Função que Cria e Incrementa o id do contador
function incid($semid, $idarq)
{
 $semaforo=sem_get($semid);
 if(sem_acquire($semaforo))
  {
   if(file_exists($idarq))
    {
     include($idarq);
     $idcont=$idcont+1;
     $resultado=$idcont;
     file_put_contents($idarq,"<?php\n"."$"."idcont=".$idcont.";\n?>");
    }
   else
    {
     file_put_contents($idarq,"<?php\n"."$"."idcont=0;\n?>");
     $resultado=0;
    }
   sem_release($semaforo);
  }
 return($resultado);
}

function tirabarraponto($caminho)
	{
	$aux_1 = explode("/",$caminho);
	$aux_2 = explode(".",$aux_1[1]);
	return $aux_1[1];	
	}


function DataPHP2SQL($data)
{
	$TemAspas = false;
	if (strpos($data, "\"") === 0) $TemAspas = true;
	if ($TemAspas) $data = str_replace("\"","",$data);

	$explodedata = explode("/",$data);
	$dia = $explodedata[0];
	$mes = $explodedata[1];
	$ano = $explodedata[2];
	if ($ano == "") $ano = date("Y");
	if ($ano < 100 && $ano !== "0000") $ano = $ano + 2000;
	$dataSQL = $ano."-".$mes."-".$dia;

	if ($TemAspas) $dataSQL = "\"".$dataSQL."\"";
	return $dataSQL;
}

function DataHoraPHP2SQL($datahora)
	{
	$TemAspas = false;
	if (strpos($datahora, "\"") === 0 ) $TemAspas = true;
	if ($TemAspas) $datahora = str_replace("\"","",$datahora); 
	
	
    $explodedatahora = explode(" ",$datahora);
	$data = $explodedatahora[0];
	$hora = $explodedatahora[1];
	$dataSQL = DataPHP2SQL($data);
	$datahoraSQL = $dataSQL." ".$hora;

	if ($TemAspas) $datahoraSQL = "\"".$datahoraSQL."\"";
	return $datahoraSQL;
	
	}
function DataSQL2PHP($data)
{
	$TemAspas = false;
	if (strpos($data, "\"") === 0) $TemAspas = true;
	if ($TemAspas) $data = str_replace("\"","",$data);

	if ($data == "") $data = date("Y-m-d");
    $explodedata = explode("-",$data);
	$dia = $explodedata[2];
	$mes = $explodedata[1];
	$ano = $explodedata[0];
	$dataPHP = $dia."/".$mes."/".$ano;

	if ($TemAspas) $dataPHP = "\"".$dataPHP."\"";
	return $dataPHP;
}

function DataHoraSQL2PHP($datahora)
	{
	$TemAspas = false;
	if (strpos($datahora, "\"") === 0) $TemAspas = true;
	if ($TemAspas) $datahora = str_replace("\"","",$datahora);

	if ($datahora == "") $datahora = date("Y-m-d H:i:s");
	$explodedatahora = explode(" ",$datahora);
	$data = $explodedatahora[0];
	$hora = $explodedatahora[1];
	$dataPHP = DataSQL2PHP($data);
	$datahoraPHP = $dataPHP." ".$hora;
	
	if ($TemAspas) $datahoraPHP = "\"".$datahoraPHP."\"";
	return $datahoraPHP;
	}




function exibeobjeto($objeto,$largura = 0,$altura = 0,$extra = "")
  {
   $posicao_separador=strrpos($objeto,".");
   
   $extensao=substr($objeto,$posicao_separador+1,strlen($objeto));
   switch(strtolower($extensao))
     {
	  case "pdf" :
	  case "doc" :
	  case "docx":
	  case "xls" :
	  case "xlsx":
	  case "ppt" :
	  case "pps" :
	    return("<a href=\"".$objeto."\" target=\"_Anexos\">".$objeto."</a>");
	  break;
	  case "swf" :
	    $aux_largura="";
		$aux_altura="";
		if($largura!=0)
		  $aux_largura="width=\"".$largura."\"";
		if($altura!=0)
		  $aux_altura="height=\"".$altura."\"";
		
	    return("<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0\" ".$aux_largura." ".$aux_altura."><param name=\"movie\" value=\"".$objeto."\" /><param name=\"quality\" value=\"high\" /><embed src=\"".$objeto."\" quality=\"high\" pluginspage=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" ".$aux_largura." ".$aux_altura." ></embed></object>");
	  
	  break;
	  default:
	    $aux_largura="";
		$aux_altura="";
		if($largura!=0)
		  $aux_largura="width=\"".$largura."\"";
		if($altura!=0)
		  $aux_altura="height=\"".$altura."\"";
	    return("<img src=\"".$objeto."\" ".$aux_largura." ".$aux_altura." ".$extra.">");
	  break;
	 }
  }
  
function MostraDescricao($Descricao)
	{
	$PosicaoStyle = strpos($Descricao,"<style");
	if ($PosicaoStyle === false)
		return nl2br($Descricao);
	else
		return $Descricao;
	}

function tirrabarraponto($caminho)
	{
	$aux_1 = explode("/",$caminho);
	$aux_2 = explode(".",$aux_1[1]);
	return $aux_1[1];	
	}

function ExibeOrderBy($Tabela, $Campo, $Aux_proxima_pagina)
  {
  $P_Var_Aux = "";
  if ($_SESSION[$Tabela]["order"] == $Campo.";asc")
    $P_Var_Aux .= "&darr;";
  else
    $P_Var_Aux .= "<a href='$Aux_proxima_pagina&order_$Tabela=$Campo;asc'>&darr;</a>";
  if ($_SESSION[$Tabela]["order"] == $Campo.";desc")
    $P_Var_Aux .= "&uarr;";
  else
    $P_Var_Aux .= "<a href='$Aux_proxima_pagina&order_$Tabela=$Campo;desc'>&uarr;</a>";
  return $P_Var_Aux;
  }

//#OUTRASFUNCOES#

?>
