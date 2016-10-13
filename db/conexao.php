<?php
	function conectar(){
		$con = mysql_connect("10.107.144.52", "root", "bcd127");
		mysql_select_db("csoptcc");
	}

	function desconectar(){
		mysql_close();
	}
?>