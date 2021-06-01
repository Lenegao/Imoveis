// Teste JS
function ConfereFloat(P_Campo, P_NomeCampo, SN) {
//Confere o Valor como 'Float'  
  P_TextoAux = document.getElementById(P_Campo).value;
  P_Texto = new String();
  P_ContaPonto = 0;
  P_Texto = P_TextoAux.replace(",",".");
  for (i = 0 ; i <= P_TextoAux.length ; i++)
	if (P_Texto.charCodeAt(i) < 48 || P_Texto.charCodeAt(i) > 57)
	  {
	  if (P_Texto.charCodeAt(i) == 46 || P_Texto.charCodeAt(i) == 44)
	    {
	    P_ContaPonto++;
        if (P_ContaPonto > 1)
          {
          alert("Erro no Cadastro do " + P_NomeCampo + "!!!\nSomente uma Virgula ou um Ponto!!!");
          return false;
          }
		}
	  else
	    {
	    alert("Erro no Cadastro do " + P_NomeCampo + "!!!\nSomente Numeros e uma Virgula ou um Ponto!!!");
        return false;
		}
	  }
//Não Aceita Nulo
  if (P_TextoAux.length == 0 && SN == 0)
    {
	alert(P_NomeCampo + " Nao Preenchido!!!");
	return false;
	}
  document.all[P_Campo].value = P_Texto;
  return true;
  };

function ConfereInteger(P_Campo, P_NomeCampo, SN) {
//Confere o Valor como 'Float'  
  P_TextoAux = document.getElementById(P_Campo).value;
  for (i = 0 ; i <= P_TextoAux.length ; i++)
	if (P_TextoAux.charCodeAt(i) < 48 || P_TextoAux.charCodeAt(i) > 57)
	  {
      alert("Erro no Cadastro do " + P_NomeCampo + "!!!\nSomente Numeros!!!");
      return false;
	  }
//Não Aceita Nulo
  if (P_TextoAux.length == 0 && SN == 0)
    {
	alert(P_NomeCampo + " Nao Preenchido!!!");
	return false;
	}
  document.all[P_Campo].value = P_TextoAux;
  return true;
  };
  
function ConfereSenhaInsert(P_Senha_1, P_Senha_2) {
//Confere as duas senhas  
	P_CampoSenha_1 = document.getElementById(P_Senha_1).value;
	P_CampoSenha_2 = document.getElementById(P_Senha_2).value;
	if (P_CampoSenha_1 != P_CampoSenha_2)
		{
		alert("Senhas Diferentes!!!");
		return false;
		}
	if (P_CampoSenha_1.length < 6)
		{
		alert("A Senha deve ter no minimo 6 caracteres!!!");
		return false;
		}
	return true;
	};
	
function ConfereSenhaUpdate(P_Senha_1, P_Senha_2) {
//Confere as duas senhas  
	P_CampoSenha_1 = document.getElementById(P_Senha_1).value;
	P_CampoSenha_2 = document.getElementById(P_Senha_2).value;
	if (P_CampoSenha_1 != P_CampoSenha_2)
		{
		alert("Senhas Diferentes!!!");
		return false;
		}
	if (P_CampoSenha_1.length < 6 && P_CampoSenha_1.length > 0)
		{
		alert("A Senha deve ter no minimo 6 caracteres!!!");
		return false;
		}
	return true;
	};
	
function ConfereNulo(P_Campo, P_NomeCampo) {
	P_TextoAux = document.getElementById(P_Campo).value;
	if (P_TextoAux.length == 0)
		{
		alert(P_NomeCampo + " Nao Preenchido!!!");
		return false;
		}
	return true;
	};
function Valida(tipo, campo, teclaPress) {
if (tipo == "FRM")
{
	tam = campo.elements.length - 3
	i = 0
	erros = 0
	while (i < tam)
	{
	  if (campo.elements[i].name){
	    aux = eval("document." + campo.name + "." + campo.elements[i].name)
	    if (aux.getAttribute("obrigatorio") == 'Sim' && (campo.elements[i].value == '' || campo.elements[i].value == '00')){
	  	  //alert (campo.elements[i].name)
		  campo.elements[i].className = "input_obrigatorio"
	      erros++
		}
	  }
	  i++
	}
	//alert (erros)
	if (erros == 0)	return true
    else return false
}
else
{
	if (window.event) {
	  var tecla = teclaPress.keyCode;
    } 
    else {
	  tecla = teclaPress.which;
    }
	if (!(tecla >= 48 && tecla <= 58 || tecla == 0 || tecla == 8 || tecla == 13))
    {
      return false
    }  
    else
	{
	  key = String.fromCharCode(tecla)
	  if (campo.value.length < campo.maxLength)
	    campo.value += key;
	  if (campo.value.length >= campo.maxLength)
	    return false
	  if (tipo == 'CPF'){
	    if (campo.value.length == 3 || campo.value.length == 7)
		  campo.value += '.'
	    if (campo.value.length == 11)
		  campo.value += '-'
	  }
	  if (tipo == 'CNPJ'){
	    if (campo.value.length == 2 || campo.value.length == 6)
		  campo.value += '.'
	    if (campo.value.length == 10)
		  campo.value += '/'
	    if (campo.value.length == 15)
		  campo.value += '-'
	  }
	  if (tipo == 'TEL'){
	    if (campo.value.length == 1)
		  campo.value = '(' + campo.value
	    if (campo.value.length == 3)
		  campo.value += ') '
	    if (campo.value.length == 9)
		  campo.value += '-'
	  }
	  if (tipo == 'DATE'){
	    if (campo.value.length == 2 || campo.value.length == 5)
		  campo.value += '/'
	  }
	  if (tipo == 'TIME'){
	    if (campo.value.length == 2 || campo.value.length == 5)
		  campo.value += ':'
	  }
	  if (tipo == 'DATETIME'){
	    if (campo.value.length == 2 || campo.value.length == 5)
		  campo.value += '/'
	    if (campo.value.length == 10)
		  campo.value += ' '
	    if (campo.value.length == 13 || campo.value.length == 16)
		  campo.value += ':'
	  }
	  if (tipo == 'CEP'){
	    if (campo.value.length == 5)
		  campo.value += '-'
	  }
	  if (tipo == 'MOEDA' || tipo == 'DECIMAL'){
	    campo.value = campo.value.replace(",","")
		while (campo.value.indexOf(0) == 0)
		  campo.value = campo.value.substr(1,campo.value.length)
		if (campo.value.length == 1)
		  campo.value = '0,0' + campo.value
		else if (campo.value.length == 2)
		  campo.value = '0,' + campo.value
	    else if (campo.value.length > 2){
		  aux = campo.value.substr(0,campo.value.length - 2)
		  aux2 = campo.value.substr(campo.value.length - 2,campo.value.length)
		  campo.value = aux + ',' + aux2
	    }
	  }
	}
  return false
  }
}
function Selecionado(campo, teclaPress) {
  campo.className = "input_selecionado"
}
function Normal(campo, teclaPress, frm) {
  campo.className = "input_normal"
  frm = eval("document." + frm)
  if (campo.name == 'cpf' && frm.acao.value == 'validar'){
	frm.submit()
  }
}
function Update(frm, campo, teclaPress) {
  frm.acao.value = ""
  frm.submit()
}

