<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Text Editor</title>
	<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
</head>
<body>
<br>
<form action="" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="flopes@comm3.com.br">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="tax" value="0">
<input type="hidden" name="lc" value="US">
</form>

<form name="RTEDemo" action="demo.php" method="post" onSubmit="return submitForm();">
<script language="JavaScript" type="text/javascript">
<!--
function submitForm() {
	//make sure hidden and iframe values are in sync before submitting form
	//to sync only 1 rte, use updateRTE(rte)
	//to sync all rtes, use updateRTEs
	updateRTE('rte1');
	//updateRTEs();
//	alert("rte1 = " + document.RTEDemo.rte1.value);
	
	//change the following line to true to submit form
	return true;
}

//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("images/", "", "");
//-->
</script>

<script language="JavaScript" type="text/javascript">
<!--
//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
Variavel = "<?php print str_replace("\r\n", "\\r\\n", str_replace("</SCRIPT>", "<\/SCRIPT>", addslashes($_POST["rte1"]))); ?>";
writeRichText('rte1', Variavel, 600, 400, true, false);
//-->
</script>
<p><input type="submit" name="submit" value="Submit"></p>
</form>

</body>
</html>