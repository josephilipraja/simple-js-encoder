<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CreaveLabs JavaScript Encoder!</title>
<script type="text/javascript">
    function select_all(obj) {
        var text_val=eval(obj);
        text_val.focus();
        text_val.select();
        if (!document.all) return; // IE only
        r = text_val.createTextRange();
        r.execCommand('copy');
    }
</script>
</head>

<body style="margin:0; font-family:Constantia, 'Lucida Bright', 'DejaVu Serif', Georgia, serif; font-size:14px; line-height:1.7em;">
<div style="float:left; width:46%; margin:2%; height:90%; position:fixed; top:0; left:0; overflow:scroll;"><form id="jsencoder" method="post" action="index.php">
<h2>CreaveLabs JavaScript Encoder</h2>
<textarea id="js" name="js" style="width:98%; font-family:Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', monospace;" rows="25"><?php echo isset($_POST["js"])?$_POST["js"]:""; ?></textarea>
<input type="submit" value="Encode!" />&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" />
</form></div>
<textarea style="float:right; width:44%; height:88%; position:fixed; top:0; right:0; margin:2%; padding:1%; background-color:#F3F3F3; color:#444; font-family:Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', monospace; font-size:12px; line-height:1.7em; overflow:scroll;" onclick="select_all(this)" readonly noresize><?php
	if(isset($_POST["js"])){
		ob_start();
		echo $_POST["js"];
		$generatedoutput = ob_get_contents();
		ob_end_clean();
		$generatedoutput = str_replace("\\\r\n", "\\n", $generatedoutput);
		$generatedoutput = str_replace("\\\n", "\\n", $generatedoutput);
		$generatedoutput = str_replace("\\\r", "\\n", $generatedoutput);
		$generatedoutput = str_replace("}\r\n", "};\r\n", $generatedoutput);
		$generatedoutput = str_replace("}\n", "};\n", $generatedoutput);
		$generatedoutput = str_replace("}\r", "};\r", $generatedoutput);
		require('javascriptpacker.php');
		$myPacker = new JavaScriptPacker($generatedoutput, 62, true, false);
		$packed = $myPacker->pack();
		echo($packed);
	}
?></textarea>
</body>
</html>