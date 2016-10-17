<?php
	function conectar(){
		$con = mysql_connect("10.107.134.40", "csop", "csoptcc@2016");
		mysql_select_db("dbcsop");
	}

	function desconectar(){
		mysql_close();
	}
?>